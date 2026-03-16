<?php

namespace App\Livewire\Setting;

use App\Models\Branch;
use App\Models\LoanCompany;
use App\Models\TransactionLog;
use Livewire\Component;
use Livewire\WithPagination;

class SystemLog extends Component
{
    use WithPagination;

    public $limit = 15;
    public $branch_id = '';
    public $operation_areas = [], $branches;
    public $loan_companies;
    public $loan_company_id;

    public $start_date, $end_date;
    public function mount()
    {
        $this->start_date = now()->startOfMonth()->toDateString();
        $this->end_date = now()->toDateString();
        if ($this->loan_companies->count() > 0) {
            $this->loan_company_id = $this->loan_companies->first()->id;
        }

        if (session()->has('branch')) {
            $this->loan_company_id = session('branch')->loan_company_id;
            $this->branch_id = session('branch_id');
        }
    }

    public function render()
    {
        // Build the query for system logs
        $systemLogs = TransactionLog::whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);

        // Apply filters based on session or component state
        if (session()->has('branch_id')) {
            $systemLogs->where('branch_id', session('branch_id'));
        }
        if (session()->has('shop_id')) {
            $systemLogs->where('shop_id', session('shop_id'));
        }
        if ($this->branch_id != '') {
            $systemLogs->where('branch_id', $this->branch_id);
        }

        // Paginate the results
        $systemLogs = $systemLogs->orderBy('created_at', 'desc')->paginate($this->limit);

        return view('livewire.setting.system-log', [
            'systemLogs' => $systemLogs
        ]);
    }

    public function setBranch($id)
    {
        $this->branch_id = $id;
        $this->resetPage(); // Reset pagination when branch changes
    }
}