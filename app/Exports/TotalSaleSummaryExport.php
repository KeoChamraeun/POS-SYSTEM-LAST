<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TotalSaleSummaryExport implements FromView
{
    protected $shops;
    protected $applicationCounts;
    protected $Qty_totals;
    protected $saleChannels;
    protected $subtotals;
    public $start_date, $end_date, $this_month;

    public function __construct($shops, $start_date, $end_date, $this_month)
    {
        $this->shops = $shops;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->this_month = $this_month;
    }

    public function view(): View
    {
        return view('exports.excel.total_sale_summary', [
            'shops' => $this->shops,
            'applicationCounts' => $this->applicationCounts,
            'Qty_totals' => $this->Qty_totals,
            'saleChannels' => $this->saleChannels,
            'subtotals' => $this->subtotals,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'this_month' => $this->this_month,
        ]);
    }
}
