<?php

namespace App\Livewire\Management\StockMovements;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StockMovement;

class StockMovementList extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $branchId = null;

    protected $listeners = [
        'refresh-stock-movements' => '$refresh',
    ];

    public function openCreateModal()
    {
        $this->dispatch('open-create-stock-movement');
    }

    public function editMovement($id)
    {
        $this->dispatch('edit-stock-movement', id: $id);
    }

    public function render()
    {
        $movements = StockMovement::with(['branch', 'product', 'user'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->whereHas('product', function ($sq) {
                        $sq->where('name', 'like', "%{$this->search}%")
                           ->orWhere('code', 'like', "%{$this->search}%");
                    })
                    ->orWhere('note', 'like', "%{$this->search}%");
                });
            })
            ->when($this->branchId, fn($q) => $q->where('branch_id', $this->branchId))
            ->latest()
            ->paginate(15);

        return view('livewire.management.stock-movements.stock-movement-list', [
            'movements' => $movements,
        ]);
    }
}