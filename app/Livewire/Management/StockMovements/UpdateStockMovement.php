<?php

namespace App\Livewire\Management\StockMovements;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\StockMovement;

class UpdateStockMovement extends Component
{
    public $movementId;
    public $note;
    public $movement;

    #[On('edit-stock-movement')]
    public function load($id)
    {
        $this->movementId = $id;
        $this->movement = StockMovement::with(['branch', 'product', 'user'])->findOrFail($id);
        $this->note = $this->movement->note;

        $this->dispatch('open-edit-stock-movement');
    }

    public function update()
    {
        $this->validate([
            'note' => 'nullable|string|max:500',
        ]);

        StockMovement::where('id', $this->movementId)->update([
            'note' => $this->note,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Stock movement updated successfully!'));
        $this->dispatch('close-edit-stock-movement');
        $this->dispatch('refresh-stock-movements');

        $this->reset(['movementId', 'note', 'movement']);
    }

    public function render()
    {
        return view('livewire.management.stock-movements.update-stock-movement', [
            'movement' => $this->movement,
        ]);
    }
}