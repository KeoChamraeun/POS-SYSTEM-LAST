<?php

namespace App\Livewire\Management\Units;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Unit;

class UnitList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-units' => '$refresh',
    ];

    public function openCreateUnitModal()
    {
        $this->dispatch('open-create-unit');
    }

    public function editUnit($unitId)
    {
        $this->dispatch('open-update-unit', unitId: $unitId);
    }

    public function render()
    {
        $units = Unit::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('short_name', 'like', "%{$this->search}%")
                  ->orWhere('symbol', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.units.unit-list', [
            'units' => $units,
        ]);
    }
}