<?php

namespace App\Livewire\Accounting\ChartofAccount;

use App\Models\ChartOfAccount;
use Livewire\Component;

class CreateAccount extends Component
{
    protected $listener = ['create_chart_account'];
    public $abbreviation, $parent_id, $description, $code;
    public $parent_accounts = [];
    protected $rules = [
        'code' => 'required',
        'abbreviation' => 'required',
    ];
    public function mount()
    {
        $this->parent_accounts = ChartOfAccount::whereNull('parent_id')->orderBy('id', 'asc')->get();
    }
    public function updatedCode()
    {
        $this->code = random_int(111111, 9999999);
    }
    public function create_chart_account()
    {
        $this->validate();
        $c_account = new ChartOfAccount();
        $c_account->code = $this->code;
        $c_account->name = $this->name;
        $c_account->abbreviation = $this->abbreviation;
        $c_account->parent_id = $this->parent_id;
        $c_account->description = $this->description;
        $c_account->save();
        $this->dispatch('modal.closeModal');
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('chart of account created successfully!')
        );
        $this->dispatch('refresh_page');
    }

    public function render()
    {
        $this->updatedCode();
        return view('livewire.accounting.chartof-account.create-account');
    }
}
