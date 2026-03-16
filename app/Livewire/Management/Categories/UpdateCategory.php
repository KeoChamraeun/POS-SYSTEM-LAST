<?php

namespace App\Livewire\Management\Categories;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Category;

class UpdateCategory extends Component
{
    public ?int $categoryId = null;

    public string $name = '';
    public string $code = '';
    public string $description = '';
    public bool $status = true;

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:120',
            'code'        => 'required|string|max:30|unique:categories,code,' . ($this->categoryId ?? 'NULL'),
            'description' => 'nullable|string|max:500',
            'status'      => 'boolean',
        ];
    }

    #[On('open-update-category-modal')]
    public function prepareEdit($categoryId)
    {
        $this->categoryId = (int) $categoryId;

        $category = Category::findOrFail($this->categoryId);

        $this->name        = $category->name;
        $this->code        = $category->code;
        $this->description = $category->description ?? '';
        $this->status      = $category->status;

        $this->resetValidation();

        $this->dispatch('show-update-category-modal');
    }

    public function update()
    {
        $this->validate();

        $category = Category::findOrFail($this->categoryId);

        $category->update([
            'name'        => $this->name,
            'code'        => strtoupper(trim($this->code)),
            'description' => $this->description ?: null,
            'status'      => $this->status,
        ]);

        $this->dispatch('show-toast', type: 'success', message: __('Category updated successfully!'));

        $this->dispatch('close-update-category-modal');
        $this->dispatch('refresh-categories');

        $this->reset(['name', 'code', 'description', 'status', 'categoryId']);
    }

    public function render()
    {
        return view('livewire.management.categories.update-category');
    }
}