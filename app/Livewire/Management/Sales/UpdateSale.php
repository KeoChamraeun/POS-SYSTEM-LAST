<?php

namespace App\Livewire\Management\Sales;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Sale;

class UpdateSale extends Component
{
    public ?Sale $sale = null;

    public $paid_amount;
    public $discount;
    public $tax;
    public $note;
    public $sale_status;

    protected $rules = [
        'paid_amount'   => 'required|numeric|min:0',
        'discount'      => 'nullable|numeric|min:0',
        'tax'           => 'nullable|numeric|min:0',
        'note'          => 'nullable|string|max:1000',
        'sale_status'   => 'required|in:completed,returned,draft',
    ];

    #[On('open-edit-sale')]
    public function loadSale($saleId)
    {
        $this->sale = Sale::with('items.product')->findOrFail($saleId);

        $this->fill([
            'paid_amount'  => $this->sale->paid_amount,
            'discount'     => $this->sale->discount,
            'tax'          => $this->sale->tax,
            'note'         => $this->sale->note,
            'sale_status'  => $this->sale->sale_status,
        ]);

        $this->dispatch('open-edit-sale-modal');
    }

    public function update()
    {
        $this->validate();

        $this->sale->update([
            'paid_amount'    => $this->paid_amount,
            'due_amount'     => $this->sale->total - $this->paid_amount,
            'discount'       => $this->discount,
            'tax'            => $this->tax,
            'note'           => $this->note,
            'sale_status'    => $this->sale_status,
            'payment_status' => $this->getUpdatedPaymentStatus(),
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Sale updated successfully'));
        $this->dispatch('close-edit-sale-modal');
        $this->dispatch('refresh-sales');

        $this->reset();
        $this->sale = null;
    }

    protected function getUpdatedPaymentStatus()
    {
        $due = $this->sale->total - $this->paid_amount;
        if ($due <= 0) return 'paid';
        if ($this->paid_amount > 0) return 'partial';
        return 'due';
    }

    public function render()
    {
        return view('livewire.management.sales.update-sale');
    }
}