<?php

namespace App\Exports;

use App\Livewire\Report\SaleSummaryReport;
use App\Models\SaleChannel;
use App\Models\SaleReport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleSummaryReportExport implements FromView
{
    public function view(): View
    {
        $salesData = ::all();

        $totals = [
            'last_month' => $salesData->sum('last_month'),
            'this_month' => $salesData->sum('this_month'),
            'difference' => $salesData->sum('difference'),
            'bamboo' => $salesData->sum('bamboo'),
            'trop_khnom' => $salesData->sum('trop_khnom'),
            'lpi_168' => $salesData->sum('lpi_168'),
            'cash' => $salesData->sum('cash'),
            'other_mfi' => $salesData->sum('other_mfi'),
            'qty_sale_daily' => $salesData->sum('qty_sale_daily'),
            'average_sale_daily' => $salesData->avg('average_sale_daily'),
        ];

        return view('exports.excel.sale-summary-report-export',
        compact('salesData', 'totals'));
    }
}
