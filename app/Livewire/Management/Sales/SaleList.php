<?php

namespace App\Livewire\Management\Sales;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Sale;

class SaleList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-sales' => '$refresh',
    ];

    public function openCreateSale()
    {
        $this->dispatch('open-create-sale');
    }

    public function editSale($saleId)
    {
        $this->dispatch('open-edit-sale', saleId: $saleId);
    }

    public function render()
    {
        $sales = Sale::with(['customer', 'branch'])
            ->when($this->search, function ($q) {
                $q->where('invoice_no', 'like', "%{$this->search}%")
                  ->orWhereHas('customer', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"));
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.sales.sale-list', compact('sales'));
    }
}