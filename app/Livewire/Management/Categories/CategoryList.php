<?php

namespace App\Livewire\Management\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-categories' => '$refresh',
    ];

    public function openCreateCategoryModal()
    {
        $this->dispatch('open-create-category-modal');
    }

    public function editCategory($categoryId)
    {
        $this->dispatch('open-update-category-modal', categoryId: $categoryId);
    }

    public function render()
    {
        $categories = Category::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.management.categories.category-list', [
            'categories' => $categories,
        ]);
    }
}