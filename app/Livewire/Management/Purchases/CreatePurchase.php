<?php

namespace App\Livewire\Management\Purchases;

use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreatePurchase extends Component
{
    public $suppliers = [];
    public $branches = [];
    public $products = [];

    public $supplier_id = '';
    public $branch_id = '';
    public $purchase_date = '';
    public $invoice_no = '';
    public $note = '';

    // Items array
    public $items = [
        ['product_id' => '', 'quantity' => 1, 'unit_cost' => 0, 'line_total' => 0, 'expiry_date' => '']
    ];

    public $subtotal = 0;
    public $discount = 0;
    public $tax = 0;
    public $paid_amount = 0;
    public $total = 0;
    public $due_amount = 0;

    protected $rules = [
        'supplier_id'    => 'required|exists:suppliers,id',
        'branch_id'      => 'required|exists:branches,id',
        'purchase_date'  => 'required|date',
        'invoice_no'     => 'required|string|max:50|unique:purchases,invoice_no',
        'items.*.product_id'  => 'required|exists:products,id',
        'items.*.quantity'    => 'required|numeric|min:0.001',
        'items.*.unit_cost'   => 'required|numeric|min:0',
        'paid_amount'    => 'nullable|numeric|min:0',
        'note'           => 'nullable|string|max:1000',
    ];

    public function mount()
    {
        $this->suppliers = Supplier::where('status', true)->get(['id', 'name']);
        $this->branches  = Branch::where('status', true)->get(['id', 'name']);
        $this->products  = Product::where('status', true)->get(['id', 'name', 'code', 'cost_price']);

        $this->purchase_date = now()->format('Y-m-d');
        $this->invoice_no = 'PUR-' . now()->format('ymdHis');
    }

    public function addItem()
    {
        $this->items[] = ['product_id' => '', 'quantity' => 1, 'unit_cost' => 0, 'line_total' => 0, 'expiry_date' => ''];
    }

    public function removeItem($index)
    {
        if (count($this->items) > 1) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
        }
    }

    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'items.')) {
            $this->calculateLineTotal(explode('.', $propertyName)[1]);
        }

        $this->calculateGrandTotals();
    }

    protected function calculateLineTotal($index)
    {
        $item = $this->items[$index];
        $this->items[$index]['line_total'] = ($item['quantity'] ?? 0) * ($item['unit_cost'] ?? 0);
    }

    protected function calculateGrandTotals()
    {
        $this->subtotal = collect($this->items)->sum('line_total');
        $this->total    = $this->subtotal - $this->discount + $this->tax;
        $this->due_amount = $this->total - $this->paid_amount;
    }

    public function save()
    {
        $this->validate();

        $purchase = Purchase::create([
            'branch_id'      => $this->branch_id,
            'supplier_id'    => $this->supplier_id,
            'user_id'        => Auth::id(),
            'invoice_no'     => $this->invoice_no,
            'purchase_date'  => $this->purchase_date,
            'subtotal'       => $this->subtotal,
            'discount'       => $this->discount,
            'tax'            => $this->tax,
            'total'          => $this->total,
            'paid_amount'    => $this->paid_amount,
            'due_amount'     => $this->due_amount,
            'payment_status' => $this->getPaymentStatus(),
            'note'           => $this->note,
            'status'         => true,
        ]);

        foreach ($this->items as $item) {
            PurchaseItem::create([
                'purchase_id'  => $purchase->id,
                'product_id'   => $item['product_id'],
                'qty'          => $item['quantity'],
                'cost_price'   => $item['unit_cost'],
                'total'        => $item['line_total'],
                'expiry_date'  => $item['expiry_date'] ?: null,
            ]);

            // TODO: update stock
            // Product::find($item['product_id'])->increment('quantity', $item['quantity']);
        }

        $this->dispatch('show-toast', type: 'success', message: __('Purchase created successfully!'));
        $this->dispatch('close-create-purchase');
        $this->dispatch('refresh-purchases');

        $this->resetExcept(['suppliers', 'branches', 'products']);
        $this->items = [['product_id' => '', 'quantity' => 1, 'unit_cost' => 0, 'line_total' => 0, 'expiry_date' => '']];
    }

    protected function getPaymentStatus()
    {
        if ($this->due_amount <= 0) return 'paid';
        if ($this->paid_amount > 0) return 'partial';
        return 'due';
    }

    public function render()
    {
        return view('livewire.management.purchases.create-purchase');
    }
}