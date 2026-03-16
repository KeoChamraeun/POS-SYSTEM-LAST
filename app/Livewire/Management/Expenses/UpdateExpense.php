<?php

namespace App\Livewire\Management\Expenses;

use Livewire\Component;
use App\Models\Expense;
use App\Models\Branch;

class UpdateExpense extends Component
{
    public $expenseId;
    public $branches = [];

    public $branch_id     = '';
    public $title         = '';
    public $category      = '';
    public $expense_date  = '';
    public $amount        = '';
    public $note          = '';

    protected $rules = [
        'branch_id'     => 'required|exists:branches,id',
        'title'         => 'required|string|max:150',
        'category'      => 'nullable|string|max:80',
        'expense_date'  => 'required|date',
        'amount'        => 'required|numeric|min:0.01',
        'note'          => 'nullable|string|max:2000',
    ];

    protected $listeners = [
        'open-edit-expense' => 'loadExpense',
    ];

    public function loadExpense($expenseId)
    {
        $this->expenseId = $expenseId;
        $expense = Expense::findOrFail($expenseId);

        $this->branch_id     = $expense->branch_id;
        $this->title         = $expense->title;
        $this->category      = $expense->category ?? '';
        $this->expense_date  = $expense->expense_date->format('Y-m-d');
        $this->amount        = $expense->amount;
        $this->note          = $expense->note ?? '';

        $this->dispatch('show-edit-expense-modal');
    }

    public function update()
    {
        $this->validate();

        $expense = Expense::findOrFail($this->expenseId);

        $expense->update([
            'branch_id'    => $this->branch_id,
            'title'        => trim($this->title),
            'category'     => trim($this->category) ?: null,
            'expense_date' => $this->expense_date,
            'amount'       => $this->amount,
            'note'         => trim($this->note) ?: null,
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Expense updated successfully');
        $this->dispatch('close-edit-expense');
        $this->dispatch('refresh-expenses');
    }

    public function render()
    {
        $this->branches = Branch::where('status', true)->get(['id', 'name']);
        return view('livewire.management.expenses.update-expense');
    }
}