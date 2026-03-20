<?php

namespace App\Livewire\POS;

use Livewire\Component;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Payment;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\StockMovement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PosSystem extends Component
{
    public $search = '';
    public $cart = []; // [product_id => ['name','code','qty','price','discount']]

    public $customer_id = null;
    public $branch_id = '';
    public $paid_amount = 0;
    public $payment_method = 'cash';
    public $note = '';

    public $products = [];
    public $customers = [];
    public $branches = [];

    protected $listeners = ['cart-changed' => '$refresh'];

    public function mount()
    {
        $this->products = Product::where('status', true)
            ->get(['id', 'name', 'code', 'selling_price']);

        $this->customers = Customer::where('status', true)
            ->get(['id', 'name']);

        $this->branches = Branch::where('status', true)
            ->get(['id', 'name']);

        $this->branch_id = $this->branches->first()?->id ?? '';
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product) return;

        $key = $productId;

        if (isset($this->cart[$key])) {
            $this->cart[$key]['qty']++;
        } else {
            $this->cart[$key] = [
                'name'     => $product->name,
                'code'     => $product->code,
                'qty'      => 1,
                'price'    => (float) $product->selling_price,
                'discount' => 0,
            ];
        }

        $this->dispatch('cart-changed');
    }

    public function increaseQty($productId)
    {
        if (isset($this->cart[$productId])) {
            $this->cart[$productId]['qty']++;
            $this->dispatch('cart-changed');
        }
    }

    public function decreaseQty($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['qty'] > 1) {
                $this->cart[$productId]['qty']--;
            } else {
                unset($this->cart[$productId]);
            }
            $this->dispatch('cart-changed');
        }
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        $this->dispatch('cart-changed');
    }

    // Computed properties
    public function getSubtotalProperty(): float
    {
        return collect($this->cart)->sum(function ($item) {
            $qty      = (float) ($item['qty'] ?? 1);
            $price    = (float) ($item['price'] ?? 0);
            $discount = (float) ($item['discount'] ?? 0);
            return ($qty * $price) - $discount;
        });
    }

    public function getTotalProperty(): float
    {
        return $this->subtotal;
    }

    public function getChangeProperty(): float
    {
        return max(0, (float)$this->paid_amount - $this->total);
    }

    public function getDueProperty(): float
    {
        return max(0, $this->total - (float)$this->paid_amount);
    }

    public function completeSale()
    {
        $this->validate([
            'branch_id'       => 'required|exists:branches,id',
            'paid_amount'     => 'required|numeric|min:0',
            'payment_method'  => 'required|in:cash,card,aba,acleda,wing,bank',
        ]);

        // ────────────────────────────────────────────────
        // 1. VALIDATE STOCK FOR ALL CART ITEMS
        // ────────────────────────────────────────────────
        $errors = [];

        foreach ($this->cart as $productId => $item) {
            $qtyWanted = (float) ($item['qty'] ?? 1);

            // Get current stock for this product + branch
            $stock = DB::table('product_stocks')
                ->where('branch_id', $this->branch_id)
                ->where('product_id', $productId)
                ->value('qty');

            $currentStock = $stock !== null ? (float) $stock : 0.00;

            if ($currentStock < $qtyWanted) {
                $productName = $item['name'] ?? "Product #{$productId}";
                $errors[] = "Not enough stock for \"{$productName}\" (available: {$currentStock}, needed: {$qtyWanted})";
            }
        }

        if (!empty($errors)) {
            $this->addError('cart', implode("\n", $errors));
            $this->dispatch('show-toast', type: 'error', message: 'Cannot complete sale - insufficient stock');
            return; // or throw ValidationException if you prefer
        }

        // ────────────────────────────────────────────────
        // 2. ALL STOCK OK → PROCEED WITH SALE
        // ────────────────────────────────────────────────
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'branch_id'      => $this->branch_id,
                'customer_id'    => $this->customer_id ?: null,
                'user_id'        => Auth::id(),
                'invoice_no'     => 'INV-' . now()->format('YmdHis'),
                'sale_date'      => now(),
                'subtotal'       => $this->subtotal,
                'discount'       => 0,
                'tax'            => 0,
                'total'          => $this->total,
                'paid_amount'    => (float) $this->paid_amount,
                'change_amount'  => $this->change,
                'due_amount'     => $this->due,
                'payment_status' => $this->due <= 0 ? 'paid' : ($this->paid_amount > 0 ? 'partial' : 'due'),
                'sale_status'    => 'completed',
                'note'           => $this->note,
            ]);

            foreach ($this->cart as $productId => $item) {
                $qty      = (float) ($item['qty'] ?? 1);
                $price    = (float) ($item['price'] ?? 0);
                $discount = (float) ($item['discount'] ?? 0);
                $lineTotal = $qty * $price - $discount;

                SaleItem::create([
                    'sale_id'    => $sale->id,
                    'product_id' => $productId,
                    'qty'        => $qty,
                    'unit_price' => $price,
                    'discount'   => $discount,
                    'total'      => $lineTotal,
                ]);

                // ─── Deduct stock from product_stocks ───
                DB::table('product_stocks')
                    ->where('branch_id', $this->branch_id)
                    ->where('product_id', $productId)
                    ->decrement('qty', $qty);

                // ─── Create stock movement record ───
                $lastMovement = StockMovement::where('product_id', $productId)
                    ->where('branch_id', $this->branch_id)
                    ->latest('id')
                    ->first();

                $currentBalance = $lastMovement ? (float) $lastMovement->balance_after : 0.00;
                $newBalance = $currentBalance - $qty;

                StockMovement::create([
                    'branch_id'     => $this->branch_id,
                    'product_id'    => $productId,
                    'type'          => 'sale',
                    'reference_id'  => $sale->id,
                    'qty_in'        => 0,
                    'qty_out'       => $qty,
                    'balance_after' => $newBalance,
                    'note'          => 'Sale #' . $sale->invoice_no,
                    'created_by'    => Auth::id(),
                ]);
            }

            // Payment record
            Payment::create([
                'branch_id'       => $this->branch_id,
                'sale_id'         => $sale->id,
                'customer_id'     => $this->customer_id,
                'payment_date'    => now(),
                'amount'          => (float) $this->paid_amount,
                'payment_method'  => $this->payment_method,
                'reference_no'    => null,
                'note'            => 'POS sale payment',
                'created_by'      => Auth::id(),
            ]);

            DB::commit();

            // Success actions
            $sale->load(['items.product', 'branch', 'customer', 'user']);

            $this->dispatch('show-toast', type: 'success', message: __('Sale completed! Invoice: ') . $sale->invoice_no);
            $this->dispatch('print-receipt', saleId: $sale->id);

            // Reset form
            $this->resetExcept(['products', 'customers', 'branches']);
            $this->cart = [];
            $this->paid_amount = 0;
            $this->note = '';
            $this->customer_id = null;

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('show-toast', type: 'error', message: 'Sale failed: ' . $e->getMessage());
            // Optional: log the error
            \Log::error('POS sale failed', ['error' => $e->getMessage(), 'cart' => $this->cart]);
        }
    }

    public function render()
    {
        return view('livewire.p-o-s.pos-system');
    }
}