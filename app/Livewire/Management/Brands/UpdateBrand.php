<?php

namespace App\Livewire\Management\Brands;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Brand;

class UpdateBrand extends Component
{
    public ?int $brandId = null;

    public string $name = '';
    public string $code = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'   => 'required|string|max:100|unique:brands,name,' . $this->brandId,
            'code'   => 'nullable|string|max:30|unique:brands,code,' . $this->brandId,
            'status' => 'boolean',
        ];
    }

    #[On('open-update-brand')]
    public function loadBrand($brandId)
    {
        $this->brandId = $brandId;

        $brand = Brand::findOrFail($this->brandId);

        $this->fill([
            'name'   => $brand->name,
            'code'   => $brand->code ?? '',
            'status' => $brand->status,
        ]);

        $this->resetValidation();
        $this->dispatch('open-update-brand-modal');
    }

    public function update()
    {
        $this->validate();

        $brand = Brand::findOrFail($this->brandId);

        $brand->update([
            'name'   => trim($this->name),
            'code'   => $this->code ? strtoupper(trim($this->code)) : null,
            'status' => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Brand updated successfully'));
        $this->dispatch('close-update-brand-modal');
        $this->dispatch('refresh-brands');

        $this->reset();
        $this->brandId = null;
    }

    public function render()
    {
        return view('livewire.management.brands.update-brand');
    }
}