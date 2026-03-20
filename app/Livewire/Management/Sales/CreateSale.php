<?php

namespace App\Livewire\Management\Sales;

use Livewire\Component;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Customer;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CreateSale extends Component
{
    public $customers = [];
    public $branches  = [];
    public $products  = [];

    public $customer_id     = null; // null = walk-in
    public $branch_id       = '';
    public $sale_date       = '';
    public $invoice_no      = '';
    public $note            = '';

    public $items = [
        ['product_id' => '', 'qty' => 1, 'unit_price' => 0, 'discount' => 0, 'total' => 0]
    ];

    public $subtotal     = 0;
    public $discount     = 0;
    public $tax          = 0;
    public $total        = 0;
    public $paid_amount  = 0;
    public $change_amount = 0;
    public $due_amount   = 0;

    protected $rules = [
        'branch_id'           => 'required|exists:branches,id',
        'sale_date'           => 'required|date',
        'invoice_no'          => 'required|string|max:50|unique:sales,invoice_no',
        'items.*.product_id'  => 'required|exists:products,id',
        'items.*.qty'         => 'required|numeric|min:0.001',
        'items.*.unit_price'  => 'required|numeric|min:0',
        'paid_amount'         => 'required|numeric|min:0',
        'note'                => 'nullable|string',
    ];

    public function mount()
    {
        $this->customers = Customer::where('status', true)->get(['id', 'name']);
        $this->branches  = Branch::where('status', true)->get(['id', 'name']);
        $this->products  = Product::where('status', true)->get(['id', 'name', 'code', 'selling_price']);

        $this->sale_date  = now()->format('Y-m-d H:i');
        $this->invoice_no = 'INV-' . now()->format('YmdHis');
    }

    public function addItem()
    {
        $this->items[] = ['product_id' => '', 'qty' => 1, 'unit_price' => 0, 'discount' => 0, 'total' => 0];
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
        $this->calculateTotals();
    }

    protected function calculateLineTotal($index)
    {
        $item = $this->items[$index] ?? null;
        if (!$item) return;

        $qty     = $item['qty'] ?? 0;
        $price   = $item['unit_price'] ?? 0;
        $disc    = $item['discount'] ?? 0;

        $this->items[$index]['total'] = ($qty * $price) - $disc;
    }

    protected function calculateTotals()
    {
        $this->subtotal     = collect($this->items)->sum('total');
        $this->total        = $this->subtotal - $this->discount + $this->tax;
        $this->due_amount   = $this->total - $this->paid_amount;
        $this->change_amount = max(0, $this->paid_amount - $this->total);
    }

    public function save()
    {
        $this->validate();

        $sale = Sale::create([
            'branch_id'      => $this->branch_id,
            'customer_id'    => $this->customer_id,
            'user_id'        => Auth::id(),
            'invoice_no'     => $this->invoice_no,
            'sale_date'      => $this->sale_date,
            'subtotal'       => $this->subtotal,
            'discount'       => $this->discount,
            'tax'            => $this->tax,
            'total'          => $this->total,
            'paid_amount'    => $this->paid_amount,
            'change_amount'  => $this->change_amount,
            'due_amount'     => $this->due_amount,
            'payment_status' => $this->getPaymentStatus(),
            'sale_status'    => 'completed',
            'note'           => $this->note,
        ]);

        foreach ($this->items as $item) {
            SaleItem::create([
                'sale_id'     => $sale->id,
                'product_id'  => $item['product_id'],
                'qty'         => $item['qty'],
                'unit_price'  => $item['unit_price'],
                'discount'    => $item['discount'],
                'total'       => $item['total'],
            ]);

            // Reduce stock
            // Product::find($item['product_id'])->decrement('quantity', $item['qty']);
        }

        $this->dispatch('show-toast', type: 'success', message: __('Sale created successfully'));
        $this->dispatch('close-create-sale');
        $this->dispatch('refresh-sales');

        $this->resetExcept(['customers', 'branches', 'products']);
        $this->items = [['product_id' => '', 'qty' => 1, 'unit_price' => 0, 'discount' => 0, 'total' => 0]];
    }

    protected function getPaymentStatus(): string
    {
        if ($this->due_amount <= 0) return 'paid';
        if ($this->paid_amount > 0) return 'partial';
        return 'due';
    }

    public function render()
    {
        return view('livewire.management.sales.create-sale');
    }
}