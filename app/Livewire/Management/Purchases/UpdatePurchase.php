<?php

namespace App\Livewire\Management\Purchases;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Purchase;

class UpdatePurchase extends Component
{
    public ?int $purchaseId = null;

    public $supplier_id;
    public $branch_id;
    public $purchase_date;
    public $invoice_no;
    public $note;
    public $paid_amount;
    public $discount;
    public $tax;

    public $purchase;

    protected $rules = [
        'paid_amount' => 'required|numeric|min:0',
        'discount'    => 'nullable|numeric|min:0',
        'tax'         => 'nullable|numeric|min:0',
        'note'        => 'nullable|string|max:1000',
    ];

    #[On('open-edit-purchase')]
    public function loadPurchase($purchaseId)
    {
        $this->purchaseId = $purchaseId;
        $this->purchase = Purchase::with('items.product')->findOrFail($purchaseId);

        $this->fill([
            'supplier_id'   => $this->purchase->supplier_id,
            'branch_id'     => $this->purchase->branch_id,
            'purchase_date' => $this->purchase->purchase_date->format('Y-m-d'),
            'invoice_no'    => $this->purchase->invoice_no,
            'note'          => $this->purchase->note,
            'paid_amount'   => $this->purchase->paid_amount,
            'discount'      => $this->purchase->discount,
            'tax'           => $this->purchase->tax,
        ]);

        $this->dispatch('open-update-purchase-modal');
    }

    public function update()
    {
        $this->validate();

        $this->purchase->update([
            'paid_amount'    => $this->paid_amount,
            'due_amount'     => $this->purchase->total - $this->paid_amount,
            'discount'       => $this->discount,
            'tax'            => $this->tax,
            'note'           => $this->note,
            'payment_status' => $this->getUpdatedPaymentStatus(),
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Purchase updated');
        $this->dispatch('close-update-purchase-modal');
        $this->dispatch('refresh-purchases');

        $this->reset();
    }

    protected function getUpdatedPaymentStatus()
    {
        $due = $this->purchase->total - $this->paid_amount;
        if ($due <= 0) return 'paid';
        if ($this->paid_amount > 0) return 'partial';
        return 'due';
    }

    public function render()
    {
        return view('livewire.management.purchases.update-purchase');
    }
}