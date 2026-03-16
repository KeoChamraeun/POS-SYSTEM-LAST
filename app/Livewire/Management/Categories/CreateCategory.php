<?php

namespace App\Livewire\Management\Categories;

use Livewire\Component;
use App\Models\Category;

class CreateCategory extends Component
{
    public string $name = '';
    public string $code = '';
    public string $description = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:120',
            'code'        => 'required|string|max:30|unique:categories,code',
            'description' => 'nullable|string|max:500',
            'status'      => 'boolean',
        ];
    }

    public function save()
    {
        $this->validate();

        Category::create([
            'name'        => $this->name,
            'code'        => strtoupper(trim($this->code)),
            'description' => $this->description ?: null,
            'status'      => $this->status,
        ]);
        $this->dispatch('show-toast', type: 'success', message: __('Category created successfully!'));
        $this->dispatch('close-create-category-modal');
        $this->dispatch('refresh-categories');

        $this->reset(['name', 'code', 'description', 'status']);
    }

    public function render()
    {
        return view('livewire.management.categories.create-category');
    }
}