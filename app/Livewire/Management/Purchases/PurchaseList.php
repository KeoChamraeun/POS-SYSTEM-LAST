<?php

namespace App\Livewire\Management\Purchases;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Purchase;

class PurchaseList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-purchases' => '$refresh',
    ];

    public function createNewPurchase()
    {
        $this->dispatch('open-create-purchase');
    }

    public function editPurchase($id)
    {
        $this->dispatch('open-edit-purchase', purchaseId: $id);
    }

    public function render()
    {
        $purchases = Purchase::query()
            ->with(['supplier', 'branch'])
            ->when($this->search, function ($q) {
                $q->where('invoice_no', 'like', "%{$this->search}%")
                  ->orWhereHas('supplier', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"))
                  ->orWhere('note', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.management.purchases.purchase-list', [
            'purchases' => $purchases,
        ]);
    }
}