<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ShopSummaryReportExport implements FromView
{
    protected $applicationCounts;
    protected $totals;
    protected $Qty_totals;

    protected $subtotals;
    public $start_date, $end_date, $item_sale_by_shops, $saleChannels;

    public function __construct($item_sale_by_shops, $saleChannels, $start_date, $end_date)
    {
        $this->item_sale_by_shops = $item_sale_by_shops;
        $this->saleChannels = $saleChannels;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function view(): View
    {
        return view('exports.excel.shop-summary-report-export', [
            'item_sale_by_shops' => $this->item_sale_by_shops,
            'saleChannels' => $this->saleChannels,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
    }
}
