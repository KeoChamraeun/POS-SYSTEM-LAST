<?php

namespace App\Livewire\Reports;

use App\Models\ChartOfAccount;
use Livewire\Component;

class TaxLawDepreciation extends Component
{
    public $month;
    public $accountId;
    public $accontId;
    public $summaryFixedAssets = [];
    public $chartAccount;

    public function mount()
    {
        $this->chartAccount = ChartOfAccount::all();
        $this->month = now()->format('Y-m');
    }

    public function render()
    {
        return view('livewire.reports.tax-law-depreciation');
    }

    public function download()
    {
        $this->dispatch(
            'show-toast',
            type: 'warning',
            message: __('This function is currently not working as intended.')
        );
    }
}
