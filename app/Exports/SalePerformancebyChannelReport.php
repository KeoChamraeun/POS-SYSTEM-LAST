<?php

namespace App\Exports;

use App\Models\SaleChannel;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class SalePerformancebyChannelReport implements FromView
{
    public $start_date;
    public $end_date;
    public $this_month;

    public function __construct($start_date, $end_date, $this_month)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->this_month = $this_month;
    }
    public function view(): View
    {
        $sale_channels = SaleChannel::with([
            'applications' => function ($query) {
                $query->whereBetween('created_at', [$this->start_date . ' 00:00:00', $this->end_date . ' 23:59:59']);
            }
        ])
            ->where('status', 1)
            ->whereNull('parent_id')
            ->orderBy('id', 'asc')
            ->get();
        return view('exports.excel.sales-performance-by-channel-report', [
            'sale_channels' => $sale_channels,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'this_month' => $this->this_month,
        ]);
    }
}