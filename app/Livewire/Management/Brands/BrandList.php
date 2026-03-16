<?php

namespace App\Livewire\Management\Brands;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;

class BrandList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-brands' => '$refresh',
    ];

    public function openCreateBrandModal()
    {
        $this->dispatch('open-create-brand');
    }

    public function editBrand($brandId)
    {
        $this->dispatch('open-update-brand', brandId: $brandId);
    }

    public function render()
    {
        $brands = Brand::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.brands.brand-list', [
            'brands' => $brands,
        ]);
    }
}