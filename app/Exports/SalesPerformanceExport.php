<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SalesPerformanceExport implements FromView
{
    /**
     * Fetch and pass the data to the export view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function view(): View
    {
        return view('exports.excel.sales-performance-export');
    }
}
