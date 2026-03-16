<?php

namespace App\Livewire\Management\Brands;

use Livewire\Component;
use App\Models\Brand;
// use Illuminate\Support\Str;

class CreateBrand extends Component
{
    public string $name = '';
    public string $code = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'  => 'required|string|max:100|unique:brands,name',
            'code'  => 'nullable|string|max:30|unique:brands,code',
            'status' => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Brand::create([
            'name'   => trim($this->name),
            'code'   => $this->code ? strtoupper(trim($this->code)) : null,
            'status' => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Brand created successfully'));
        $this->dispatch('close-create-brand');
        $this->dispatch('refresh-brands');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.management.brands.create-brand');
    }
}