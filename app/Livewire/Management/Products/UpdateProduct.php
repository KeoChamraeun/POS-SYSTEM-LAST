<?php

namespace App\Livewire\Management\Products;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\ProductStock;
use Illuminate\Support\Str;

class UpdateProduct extends Component
{
    public ?int $productId = null;

    public string $name = '';
    public string $code = '';
    public string $barcode = '';
    public ?int $category_id = null;
    public ?int $brand_id = null;
    public ?int $unit_id = null;
    public float $cost_price = 0;
    public float $selling_price = 0;
    public float $alert_qty = 0;
    public string $description = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'          => 'required|string|max:150',
            'code'          => 'required|string|max:50|unique:products,code,' . $this->productId,
            'barcode'       => 'nullable|string|max:50|unique:products,barcode,' . $this->productId,
            'category_id'   => 'nullable|exists:categories,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'unit_id'       => 'required|exists:units,id',
            'cost_price'    => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:cost_price',
            'alert_qty'     => 'required|numeric|min:0',
            'description'   => 'nullable|string|max:2000',
            'status'        => 'boolean',
        ];
    }

    #[On('open-update-product')]
    public function loadProduct($productId)
    {
        $this->productId = $productId;

        $product = Product::findOrFail($this->productId);

        $this->fill([
            'name'          => $product->name,
            'code'          => $product->code,
            'barcode'       => $product->barcode ?? '',
            'category_id'   => $product->category_id,
            'brand_id'      => $product->brand_id,
            'unit_id'       => $product->unit_id,
            'cost_price'    => $product->cost_price,
            'selling_price' => $product->selling_price,
            'alert_qty'     => $product->alert_qty,
            'description'   => $product->description ?? '',
            'status'        => $product->status,
        ]);

        $this->resetValidation();

        $this->dispatch('open-update-product-modal');
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->productId);

        $product->update([
            'name'          => trim($this->name),
            'slug'          => Str::slug($this->name),
            'code'          => strtoupper(trim($this->code)),
            'barcode'       => trim($this->barcode) ?: null,
            'category_id'   => $this->category_id,
            'brand_id'      => $this->brand_id,
            'unit_id'       => $this->unit_id,
            'cost_price'    => $this->cost_price,
            'selling_price' => $this->selling_price,
            'alert_qty'     => $this->alert_qty,
            'description'   => trim($this->description) ?: null,
            'status'        => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Product updated successfully'));
        $this->dispatch('close-update-product-modal');
        $this->dispatch('refresh-products');

        $this->reset();
        $this->productId = null;
    }

    public function render()
    {
        return view('livewire.management.products.update-product', [
            'categories' => Category::where('status', true)->get(['id', 'name']),
            'brands'     => Brand::where('status', true)->get(['id', 'name']),
            'units'      => Unit::all(['id', 'name', 'symbol']),
        ]);
    }
}