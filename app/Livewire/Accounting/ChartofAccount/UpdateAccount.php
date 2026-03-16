<?php

namespace App\Livewire\Accounting\ChartofAccount;

use App\Models\ChartOfAccount;
use GPBMetadata\Google\Api\Auth;
use Livewire\Component;

class UpdateAccount extends Component
{
    protected $listeners = ['modal.openUpdateModal' => 'update_account', 'update_chart_account'];
    public $code, $abbreviation, $description, $parent_id, $account_id, $name;
    public $parent_accounts = [];

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
    ];
    public function update_account($acc_id)
    {
        $chart_account = ChartOfAccount::find($acc_id);
        $this->account_id = $acc_id;
        $this->name = $chart_account->name;
        $this->code = $chart_account->code;
        $this->parent_id = $chart_account->parent_id;
        $this->abbreviation = $chart_account->abbreviation;
        $this->description = $chart_account->description;
    }

    public function update_chart_account()
    {
        $this->validate();
        $acc = ChartOfAccount::find($this->account_id);
        $acc->code = $this->code;
        $acc->name = $this->name;
        $acc->parent_id = $this->parent_id;
        $acc->abbreviation = $this->abbreviation;
        $acc->description = $this->description;
        $acc->save();
        $this->dispatch(
            'show-toast',
            type: 'success',
            message: __('Chart of account updated successfully!')
        );
        $this->dispatch('modal.closeUpdateModal');
    }

    public function mount()
    {
        $this->parent_accounts = ChartOfAccount::whereNull('parent_id')->orderBy('id', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.accounting.chartof-account.update-account');
    }
}
