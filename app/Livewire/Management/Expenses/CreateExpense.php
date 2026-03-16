<?php

namespace App\Livewire\Management\Expenses;

use Livewire\Component;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class CreateExpense extends Component
{
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

    public function mount()
    {
        $this->branches = Branch::where('status', true)->get(['id', 'name']);
        $this->branch_id = Auth::user()->branch_id ?? ($this->branches->first()?->id ?? '');
        $this->expense_date = now()->format('Y-m-d');
    }

    public function save()
    {
        $this->validate();

        \App\Models\Expense::create([
            'branch_id'    => $this->branch_id,
            'user_id'      => Auth::id(),
            'title'        => trim($this->title),
            'category'     => trim($this->category) ?: null,
            'expense_date' => $this->expense_date,
            'amount'       => $this->amount,
            'note'         => trim($this->note) ?: null,
        ]);

        $this->dispatch('show-toast', type: 'success', message: 'Expense recorded successfully');
        $this->dispatch('close-create-expense');
        $this->dispatch('refresh-expenses');

        $this->resetExcept('branches', 'branch_id');
        $this->expense_date = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.management.expenses.create-expense');
    }
}