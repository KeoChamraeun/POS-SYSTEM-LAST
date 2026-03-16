<?php

namespace App\Livewire\Management\Expenses;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;

class ExpenseList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-expenses' => '$refresh',
    ];

    public function openCreateExpense()
    {
        $this->dispatch('open-create-expense');
    }

    public function editExpense($id)
    {
        $this->dispatch('open-edit-expense', expenseId: $id);
    }

    public function render()
    {
        $expenses = Expense::query()
            ->with(['branch', 'user'])
            ->when($this->search, function ($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('category', 'like', "%{$this->search}%")
                  ->orWhere('note', 'like', "%{$this->search}%")
                  ->orWhereHas('branch', fn($sq) => $sq->where('name', 'like', "%{$this->search}%"));
            })
            ->latest('expense_date')
            ->paginate(15);

        return view('livewire.management.expenses.expense-list', compact('expenses'));
    }
}