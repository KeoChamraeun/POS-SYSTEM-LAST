<?php

namespace App\Exports;

use App\Models\Application;
use Illuminate\Contracts\View\View;
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

    protected function cleanString($value)
    {
        if (is_null($value) || $value === '') {
            return '';
        }

        $value = (string) $value;

        if (!mb_check_encoding($value, 'UTF-8')) {
            $value = mb_convert_encoding($value, 'UTF-8', mb_detect_encoding($value, 'UTF-8, ISO-8859-1, WINDOWS-1252', true) ?: 'auto');
        }
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F-\x9F]/u', '', $value);
        $value = str_replace(["\r", "\xC2\xA0"], ['', ' '], $value);
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_XML1, 'UTF-8', false);
        $value = mb_substr($value, 0, 32767, 'UTF-8');

        return trim($value);
    }

    public function view(): View
    {
        // Sanitize application data
        $sanitizedApplications = $this->applications->map(function ($app) {
            $app->customer_name = $this->cleanString($app->customer->name ?? $app->customer_name_translate ?? '');
            $app->credit_branch = $this->cleanString(optional($app->shop->operational_area)->local_code ?? '');
            $app->phone_number = $this->cleanString($app->customer->phone ?? '');
            $app->village = $this->cleanString(optional($app->address->village)->name ?? '');
            $app->commune = $this->cleanString(optional($app->address->commune)->name ?? '');
            $app->district = $this->cleanString(optional($app->address->district)->name ?? '');
            $app->province = $this->cleanString(optional($app->address->city)->name ?? '');
            $app->sale_channel = $this->cleanString(optional($app->sale_channel)->name ?? '');
            $app->agent_name = $this->cleanString($app->agent_name ?? '');
            $app->agent_code = $this->cleanString($app->agent_code ?? '');
            $app->co_phone = $this->cleanString(optional($app->co)->phone ?? '');
            $app->condition = $this->cleanString($app->condition ?? '');
            $app->brand = $this->cleanString(optional($app->product->brand)->name ?? '');
            $app->year = $this->cleanString($app->product->year_of_manufacture ?? '');
            $app->co_name = $this->cleanString(optional($app->co)->name ?? '');
            $app->credit_partner = $this->cleanString(optional($app->loan_company)->name ?? '');
            $app->status = $this->cleanString(match ($app->status) {
                '2' => 'Approved',
                '1' => 'Follow Up',
                '3' => 'New Application',
                default => 'Rejected',
            });
            return $app;
        });

        return view('exports.excel.daily-sale-report', [
            'applications' => $sanitizedApplications,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);
    }
}
