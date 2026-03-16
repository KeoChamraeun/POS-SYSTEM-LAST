<?php

namespace App\Livewire\Accounting\ChartofAccount;

use App\Models\ChartOfAccount;
use Livewire\Component;
use Livewire\WithPagination;

class AccountList extends Component
{
    protected $listeners = ['refresh_page' => 'render', 'update_chart_account' => 'render'];
    use WithPagination;
    public $search = '';
    protected $queryString = ['search'];
    public $limit = 10;
    public function render()
    {
        $chart_accounts = ChartOfAccount::query()
            ->when($this->search, function ($q) {
                $q->where('code', 'like', '%' . $this->search . '%')
                    ->orWhere('abbreviation', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc');
        $chart_accounts = $chart_accounts->paginate($this->limit);
        return view('livewire.accounting.chartof-account.account-list', [
            'chart_accounts' => $chart_accounts,
        ]);
    }

    public function open_new_modal()
    {
        $this->dispatch('modal.openModal');
    }

    public function open_update_modal($acc_id)
    {
        $this->dispatch('modal.openUpdateModal', acc_id: $acc_id);
    }
}
