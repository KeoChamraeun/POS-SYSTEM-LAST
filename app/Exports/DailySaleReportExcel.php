<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class DailySaleReportExcel implements FromView
{
    protected $applications, $start_date, $end_date, $shop_id, $branch_id, $loan_company_id, $operational_area_id;
    public function __construct($applications, $operational_area_id, $branch_id, $shop_id, $start_date, $end_date, $loan_company_id)
    {
        $this->applications = $applications;
        $this->operational_area_id = $operational_area_id;
        $this->branch_id = $branch_id;
        $this->shop_id = $shop_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->loan_company_id = $loan_company_id;
    }
    public function view(): View
    {
        return view('exports.excel.daily-sale-report', [
            'applications' => $this->applications,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ]);
    }
}
