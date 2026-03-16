<?php

namespace App\Livewire\Management\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class ProductList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-products' => '$refresh',
    ];

    public function openCreateProductModal()
    {
        $this->dispatch('open-create-product');
    }

    public function editProduct($productId)
    {
        $this->dispatch('open-update-product', productId: $productId);
    }

    public function render()
    {
        $products = Product::with(['category', 'brand', 'unit'])
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%")
                  ->orWhere('barcode', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(15);

        return view('livewire.management.products.product-list', [
            'products' => $products,
        ]);
    }
}