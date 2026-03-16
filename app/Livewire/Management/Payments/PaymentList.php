<?php

namespace App\Livewire\Management\Payments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;

class PaymentList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-payments' => '$refresh',
    ];

    public function openCreatePayment()
    {
        $this->dispatch('open-create-payment');
    }

    public function editPayment($id)
    {
        $this->dispatch('open-edit-payment', paymentId: $id);
    }

    public function render()
    {
        $payments = Payment::query()
            ->with(['branch', 'customer', 'supplier', 'sale', 'purchase', 'creator'])
            ->when($this->search, function ($q) {
                $q->where('reference_no', 'like', "%{$this->search}%")
                  ->orWhereHas('customer', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
                  ->orWhereHas('supplier', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
                  ->orWhere('note', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(12);

        return view('livewire.management.payments.payment-list', compact('payments'));
    }
}