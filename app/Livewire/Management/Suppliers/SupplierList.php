<?php

namespace App\Livewire\Management\Suppliers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Supplier;

class SupplierList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-suppliers' => '$refresh',
    ];

    public function openCreateSupplierModal()
    {
        $this->dispatch('open-create-supplier');
    }

    public function editSupplier($supplierId)
    {
        $this->dispatch('open-update-supplier', supplierId: $supplierId);
    }

    public function render()
    {
        $suppliers = Supplier::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%")
                  ->orWhere('company_name', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.suppliers.supplier-list', [
            'suppliers' => $suppliers,
        ]);
    }
}