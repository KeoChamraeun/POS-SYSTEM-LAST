<?php

namespace App\Livewire\Management\Units;

use Livewire\Component;
use App\Models\Unit;

class CreateUnit extends Component
{
    public string $name = '';
    public string $short_name = '';
    public string $symbol = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'       => 'required|string|max:100|unique:units,name',
            'short_name' => 'required|string|max:20|unique:units,short_name',
            'symbol'     => 'nullable|string|max:10',
            'status'     => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Unit::create([
            'name'       => trim($this->name),
            'short_name' => strtoupper(trim($this->short_name)),
            'symbol'     => trim($this->symbol) ?: null,
            'status'     => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Unit created successfully'));
        $this->dispatch('close-create-unit');
        $this->dispatch('refresh-units');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.management.units.create-unit');
    }
}