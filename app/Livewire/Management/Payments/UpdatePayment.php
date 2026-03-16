<?php

namespace App\Livewire\Management\Payments;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Branch;

class UpdatePayment extends Component
{
    public ?Payment $payment = null;

    public $branch_id;
    public $payment_date;
    public $amount;
    public $payment_method;
    public $reference_no;
    public $note;

    protected $rules = [
        'branch_id'        => 'required|exists:branches,id',
        'payment_date'     => 'required|date',
        'amount'           => 'required|numeric|min:0.01',
        'payment_method'   => 'required|in:cash,card,aba,acleda,wing,bank',
        'reference_no'     => 'nullable|string|max:100',
        'note'             => 'nullable|string|max:1500',
    ];

    #[On('open-edit-payment')]
    public function loadPayment($paymentId)
    {
        $this->payment = Payment::findOrFail($paymentId);

        $this->fill([
            'branch_id'       => $this->payment->branch_id,
            'payment_date'    => $this->payment->payment_date->format('Y-m-d\TH:i'),
            'amount'          => $this->payment->amount,
            'payment_method'  => $this->payment->payment_method,
            'reference_no'    => $this->payment->reference_no,
            'note'            => $this->payment->note,
        ]);

        $this->dispatch('open-update-payment-modal');
    }

    public function update()
    {
        $this->validate();

        $this->payment->update([
            'branch_id'       => $this->branch_id,
            'payment_date'    => $this->payment_date,
            'amount'          => $this->amount,
            'payment_method'  => $this->payment_method,
            'reference_no'    => trim($this->reference_no) ?: null,
            'note'            => trim($this->note) ?: null,
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Payment updated successfully');
        $this->dispatch('close-update-payment-modal');
        $this->dispatch('refresh-payments');

        $this->reset();
        $this->payment = null;
    }

    public function render()
    {
        $branches = Branch::where('status', true)->get(['id', 'name']);

        return view('livewire.management.payments.update-payment', compact('branches'));
    }
}