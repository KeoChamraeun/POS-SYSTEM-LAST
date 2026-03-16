<?php

namespace App\Livewire\Management\StockMovements;

use Livewire\Component;
use App\Models\StockMovement;
use App\Models\Branch;
use App\Models\Product;

class CreateStockMovement extends Component
{
    public $branch_id;
    public $product_id;
    public $type = 'adjustment';
    public $qty_in = 0;
    public $qty_out = 0;
    public $note;

    protected $rules = [
        'branch_id'  => 'required|exists:branches,id',
        'product_id' => 'required|exists:products,id',
        'type'       => 'required|in:purchase,sale,sale_return,purchase_return,adjustment',
        'qty_in'     => 'required|numeric|min:0',
        'qty_out'    => 'required|numeric|min:0',
        'note'       => 'nullable|string|max:500',
    ];

    public function save()
    {
        $this->validate();

        // For simplicity – in real system balance_after should be calculated
        $lastMovement = StockMovement::where('product_id', $this->product_id)
            ->where('branch_id', $this->branch_id)
            ->latest()
            ->first();

        $currentBalance = $lastMovement ? $lastMovement->balance_after : 0;

        $newBalance = $currentBalance + $this->qty_in - $this->qty_out;

        StockMovement::create([
            'branch_id'     => $this->branch_id,
            'product_id'    => $this->product_id,
            'type'          => $this->type,
            'qty_in'        => $this->qty_in,
            'qty_out'       => $this->qty_out,
            'balance_after' => $newBalance,
            'note'          => $this->note,
            'created_by'    => auth()->id(),
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Stock movement created successfully!'));
        $this->dispatch('close-create-stock-movement');
        $this->dispatch('refresh-stock-movements');

        $this->resetExcept();
    }

    public function render()
    {
        return view('livewire.management.stock-movements.create-stock-movement', [
            'branches' => Branch::where('status', true)->get(['id', 'name']),
            'products' => Product::where('status', true)->get(['id', 'name']),
        ]);
    }
}