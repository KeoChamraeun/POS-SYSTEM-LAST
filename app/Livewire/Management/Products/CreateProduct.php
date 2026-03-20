<?php

namespace App\Livewire\Management\Products;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Branch;
use App\Models\ProductStock;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
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

    // New fields: initial stock (optional)
    public ?int $initial_branch_id = null;
    public float $initial_qty = 0;

    protected function rules(): array
    {
        return [
            'name'          => 'required|string|max:150',
            'code'          => 'required|string|max:50|unique:products,code',
            'barcode'       => 'nullable|string|max:50|unique:products,barcode',
            'category_id'   => 'nullable|exists:categories,id',
            'brand_id'      => 'nullable|exists:brands,id',
            'unit_id'       => 'required|exists:units,id',
            'cost_price'    => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:cost_price',
            'alert_qty'     => 'required|numeric|min:0',
            'description'   => 'nullable|string|max:2000',
            'status'        => 'boolean',

            // Initial stock fields (both optional)
            'initial_branch_id' => 'nullable|exists:branches,id',
            'initial_qty'       => 'nullable|numeric|min:0',
        ];
    }

    public function save()
    {
        $this->validate();

        // Create the product
        $product = Product::create([
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

        // If initial stock is provided, create the stock record
        if ($this->initial_branch_id && $this->initial_qty > 0) {
            ProductStock::create([
                'branch_id'  => $this->initial_branch_id,
                'product_id' => $product->id,
                'qty'        => $this->initial_qty,
            ]);
        }

        // Success feedback
        $this->dispatch('show-toast', type: 'success', message: __('Product created successfully'));
        $this->dispatch('close-create-product');
        $this->dispatch('refresh-products');

        // Reset form
        $this->reset();
        $this->initial_branch_id = null;
        $this->initial_qty = 0;
    }

    public function render()
    {
        return view('livewire.management.products.create-product', [
            'categories' => Category::where('status', true)->get(['id', 'name']),
            'brands'     => Brand::where('status', true)->get(['id', 'name']),
            'units'      => Unit::all(['id', 'name', 'symbol']),
            'branches'   => Branch::where('status', true)->get(['id', 'name']),
        ]);
    }
}