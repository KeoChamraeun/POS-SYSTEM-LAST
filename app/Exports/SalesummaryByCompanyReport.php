<?php

namespace App\Exports;

use App\Models\Shop;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalesummaryByCompanyReport implements FromView
{
    public $start_date, $end_date, $today_date, $last_month_start, $last_month_end, $day_in_current_month;
    public $item_sale_by_shops = [];
    public function __construct($item_sale_by_shops, $start_date, $end_date, $today_date, $last_month_start, $last_month_end, $day_in_current_month)
    {
        $this->item_sale_by_shops = $item_sale_by_shops;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->today_date = $today_date;
        $this->last_month_start = $last_month_start;
        $this->last_month_end = $last_month_end;
        $this->day_in_current_month = $day_in_current_month;
    }

    public function view(): View
    {

        return view('exports.excel.sales-summary-by-company-report', [
            'item_sale_by_shops' => $this->item_sale_by_shops,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'today_date' => $this->today_date,
            'last_month_start' => $this->last_month_start,
            'last_month_end' => $this->last_month_end,
            'day_in_current_month' => $this->day_in_current_month,
        ]);
    }
}
