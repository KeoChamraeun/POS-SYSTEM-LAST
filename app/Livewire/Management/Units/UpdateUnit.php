<?php

namespace App\Livewire\Management\Units;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Unit;

class UpdateUnit extends Component
{
    public ?int $unitId = null;

    public string $name = '';
    public string $short_name = '';
    public string $symbol = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'       => 'required|string|max:100|unique:units,name,' . $this->unitId,
            'short_name' => 'required|string|max:20|unique:units,short_name,' . $this->unitId,
            'symbol'     => 'nullable|string|max:10',
            'status'     => 'boolean',
        ];
    }

    #[On('open-update-unit')]
    public function loadUnit($unitId)
    {
        $this->unitId = $unitId;

        $unit = Unit::findOrFail($this->unitId);

        $this->fill([
            'name'       => $unit->name,
            'short_name' => $unit->short_name,
            'symbol'     => $unit->symbol ?? '',
            'status'     => $unit->status,
        ]);

        $this->resetValidation();

        $this->dispatch('open-update-unit-modal');
    }

    public function update()
    {
        $this->validate();

        $unit = Unit::findOrFail($this->unitId);

        $unit->update([
            'name'       => trim($this->name),
            'short_name' => strtoupper(trim($this->short_name)),
            'symbol'     => trim($this->symbol) ?: null,
            'status'     => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Unit updated successfully'));
        $this->dispatch('close-update-unit-modal');
        $this->dispatch('refresh-units');

        $this->reset();
        $this->unitId = null;
    }

    public function render()
    {
        return view('livewire.management.units.update-unit');
    }
}