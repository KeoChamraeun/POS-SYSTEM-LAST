<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Sale Performance Channel Report') }}</title>
    <style>
        table,
        td {
            border: 1px solid gray;
            border-collapse: collapse;
            font-size: 24px;
            color: gray;
            padding: 3px;
            word-wrap: break-word;
            white-space: nowrap;
        }

        th {
            border: 1px solid grey;
            font-size: 24px;
            color: gray;
            padding: 3px;
            word-wrap: break-word;
        }
    </style>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan="24" style="text-align:center;">
                    <div style="font-weight: 700; font-size: 14px; font-family: KhmerOS_muollight">
                        <strong>{{ env('APP_HEADER_NAME_KH') }}</strong>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="24" style="text-align:center;">
                    <p style="font-family:'KhmerOSbattambang';">{{ env('APP_HEADER_NAME') }}</p>
                </th>
            </tr>
            <tr>
                <th colspan="24" style="text-align:center;">
                    <p
                        style="text-align:center; font-size: 24px !important; font-family:'KhmerOSbattambang' !important;">
                        {{ __('Sale Performance By Channel Report') }}
                    </p>
                </th>
            </tr>
            <tr>
                <th colspan="24" style="text-align:center; color:#daad5c; font-family:'KhmerOSbattambang';">
                    <p style="color: #daad5c; font-family:'KhmerOSbattambang';">
                        {{ __('Monthly') }} {{ trans(date('F', strtotime($start_date))) }} {{ __('Year') }}
                        {{ date('Y', strtotime($start_date)) }}
                        ({{ date('d', strtotime($start_date)) . '-' . __(date('F', strtotime($start_date))) . '-' . date('Y', strtotime($start_date)) }})
                        {{ __('To Date') }}
                        ({{ date('d', strtotime($end_date)) . '-' . __(date('F', strtotime($end_date))) . '-' . date('Y', strtotime($end_date)) }})
                    </p>
                </th>
            </tr>
            <tr>
                <th rowspan="2" style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('No.') }}</th>
                <th rowspan="2" style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Source Client') }}
                </th>
                <th colspan="4" style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Target Sales') }}
                </th>
                <th colspan="2" class="text-black bg-success"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th colspan="10" class="text-black bg-success"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approval By MFI') }}
                </th>
                <th colspan="2" class="text-black bg-secondary"
                    style="text-align: center; background: gray; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow up') }}
                </th>
                <th colspan="2" class="text-black bg-danger"
                    style="text-align: center; background:red; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Rejected') }}
                </th>
                <th rowspan="2"
                    style="background-color: #DDEBF7; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Grand Total') }}
                </th>
                <th rowspan="2" class="highlight text-black"
                    style="background-color: #FFFF00; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Rating Approval by Channels') }}
                </th>
            </tr>
            <tr>
                <th style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('Plan') }}</th>
                <th style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('Bal. As At') }}</th>
                <th class="text-danger text-nowrap" style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Variance') }}
                </th>
                <th class="text-danger" style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Achieved') }} (%)
                </th>
                <th class="text-black"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    #
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black text-nowrap"
                    style="text-align: center !important; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ get_single_mfi(1) }}
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black text-nowrap"
                    style="text-align: center !important; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ get_single_mfi(2) }}
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black text-nowrap"
                    style="text-align: center !important; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ get_single_mfi(3) }}
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black text-nowrap"
                    style="text-align: center !important; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ get_single_mfi(4) }}
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black text-nowrap"
                    style="text-align: center !important; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ get_single_mfi(5) }}
                </th>
                <th class="text-danger"
                    style="text-align: center; background: green; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black"
                    style="text-align: center; background: gray; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    #
                </th>
                <th class="text-black"
                    style="text-align: center; background: gray; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    %
                </th>
                <th class="text-black"
                    style="background: red; font-family:'KhmerOSbattambang'; border: 1px solid gray;">#</th>
                <th class="text-black"
                    style="background: red; font-family:'KhmerOSbattambang'; border: 1px solid gray;">%</th>
            </tr>
        </thead>
        <tbody>
            <?php

            use App\Models\Application;
            use App\Models\SaleChannelTarget;

            $total_plan = 0;
            $total_variance = 0;
            $total_achieved = 0;
            $total_approved = 0;
            $total_approve_percent = 0;
            $total_follow_up = 0;
            $total_follow_up_percent = 0;
            $total_reject = 0;
            $total_reject_percent = 0;
            $total_grand_total = 0;
            $total_bbf_approved = 0;
            $total_tk_approved = 0;
            $total_lpi_approved = 0;
            $total_other_mfi_approved = 0;
            $total_cash_approved = 0;
            $total_bbf_approve_percent = 0;
            $total_tk_approve_percent = 0;
            $total_lpi_approve_percent = 0;
            $total_other_mfi_approve_percent = 0;
            $total_cash_approve_percent = 0;
            $total_balance_as_at = 0;

            $total_sale_application = Application::where('status', 2)->whereBetween('created_at', ["$start_date 00:00:00", "$end_date 23:59:59"]);
            $total_follow_up_application = Application::where('status', 1)->whereBetween('created_at', ["$start_date 00:00:00", "$end_date 23:59:59"]);
            $total_reject_application = Application::where('status', 0)->whereBetween('created_at', ["$start_date 00:00:00", "$end_date 23:59:59"]);

            $application_all_mfi = Application::where('status', 2)->whereBetween('created_at', ["$start_date 00:00:00", "$end_date 23:59:59"]);
            $total_bbf_approve_application = $application_all_mfi->where('loan_company_id', 1);
            $total_tk_approve_application = $application_all_mfi->where('loan_company_id', 2);
            $total_lpi_approve_application = $application_all_mfi->where('loan_company_id', 3);
            $total_other_mfi_approve_application = $application_all_mfi->where('loan_company_id', 4);
            $total_cash_approve_application = $application_all_mfi->where('loan_company_id', 5);
            ?>
            @foreach ($sale_channels as $i => $chan)
            <?php
            $approve_application = $chan->applications ? $chan->applications->where('status', 2)->count() : 0;
            $followup_application = $chan->applications ? $chan->applications->where('status', 1)->count() : 0;
            $reject_application = $chan->applications ? $chan->applications->where('status', 0)->count() : 0;
            $grand_total_application = $chan->applications ? $chan->applications->count() : 0;
            $total_grand_total += $grand_total_application;

            $plan_sale = SaleChannelTarget::where('sale_channel_id', $chan->id)->whereDate('start_date', $start_date)->first();
            $balance_of_target_sale = SaleChannelTarget::where('sale_channel_id', $chan->id)->whereDate('start_date', '<=', $start_date)->sum('target_sale');
            $total_application_sale = Application::where('sale_channel_id', $chan->id)->whereDate('created_at', '<=', $end_date)->where('status', 2)->count();

            $total_plan += $plan_sale ? $plan_sale->target_sale : 0;
            $total_balance_as_at += $balance_of_target_sale - $total_application_sale;
            $total_variance += $balance_of_target_sale - $total_application_sale - $approve_application;
            $total_approved += $approve_application;
            $total_follow_up += $followup_application;
            $total_reject += $reject_application;

            $total_bbf_approved += $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 1)->count() : 0;
            $total_tk_approved += $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 2)->count() : 0;
            $total_lpi_approved += $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 3)->count() : 0;
            $total_other_mfi_approved += $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 4)->count() : 0;
            $total_cash_approved += $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 5)->count() : 0;
            $percent_of_achieved = $balance_of_target_sale - $total_application_sale;

            if ($balance_of_target_sale && $total_balance_as_at) {
                $total_achieved = ($total_approved / $total_balance_as_at) * 100;
            }
            if ($chan->applications && $chan->applications->where('status', 2)->count() > 0 && $total_sale_application->count() > 0) {
                $total_approve_percent += ((float) $chan->applications->where('status', 2)->count() / (float) $total_sale_application->count()) * 100;
            }

            if ($total_follow_up_application->count() > 0) {
                $total_follow_up_percent += ((float) ($chan->applications ? $chan->applications->where('status', 1)->count() : 0) / (float) $total_follow_up_application->count()) * 100;
            }
            if ($total_reject_application->count() > 0) {
                $total_reject_percent += ((float) ($chan->applications ? $chan->applications->where('status', 0)->count() : 0) / (float) $total_reject_application->count()) * 100;
            }
            if ($chan->applications && $chan->applications->where('status', 2)->count() > 0 && $total_bbf_approve_application->count() > 0) {
                $total_bbf_approve_percent += ((float) $chan->applications->where('status', 2)->where('loan_company_id', 1)->count() / (float) $total_bbf_approve_application->count()) * 100;
            }
            if ($total_tk_approve_application->count() > 0) {
                $total_tk_approve_percent += ((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 2)->count() : 0) / (float) $total_tk_approve_application->count()) * 100;
            }
            if ($total_lpi_approve_application->count() > 0) {
                $total_lpi_approve_percent += ((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 3)->count() : 0) / (float) $total_lpi_approve_application->count()) * 100;
            }
            if ($total_other_mfi_approve_application->count() > 0) {
                $total_other_mfi_approve_percent += ((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 4)->count() : 0) / (float) $total_other_mfi_approve_application->count()) * 100;
            }
            if ($total_cash_approve_application->count() > 0) {
                $total_cash_approve_percent += ((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 5)->count() : 0) / (float) $total_cash_approve_application->count()) * 100;
            }
            ?>
            <tr>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ ++$i }}</td>
                <td style="font-family:'KhmerOSbattambang';">
                    {{ label_translation($chan) }}
                </td>
                <!-- Plan -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $plan_sale ? $plan_sale->target_sale : 0 }}
                </td>
                <!-- balance as at -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    @if ($balance_of_target_sale)
                    {{ abs($total_application_sale - $balance_of_target_sale) }}
                    @endif
                </td>
                <!-- Variance -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($balance_of_target_sale)
                    {{ abs($balance_of_target_sale - $total_application_sale - $approve_application) }}
                    @endif
                </td>
                <!-- Achieved -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($percent_of_achieved > 0)
                    {{ number_format(($approve_application / $percent_of_achieved) * 100) }} %
                    @else
                    0 %
                    @endif
                </td>
                <!-- Approve -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $approve_application }}
                </td>
                <!-- percent of approve -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($approve_application > 0 && $total_sale_application->count() > 0)
                    {{ number_format(((float) $approve_application / (float) $total_sale_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- approve of bb -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 1)->count() : 0 }}
                </td>
                <!-- percent approve of bb -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_bbf_approve_application->count() > 0)
                    {{ number_format(((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 1)->count() : 0) / (float) $total_bbf_approve_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- approve of TK -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 2)->count() : 0 }}
                </td>
                <!-- Percent of T -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_tk_approve_application->count() > 0)
                    {{ number_format(((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 2)->count() : 0) / (float) $total_tk_approve_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- Approve of LP -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 3)->count() : 0 }}
                </td>
                <!-- Percent of lp -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_lpi_approve_application->count() > 0)
                    {{ number_format(((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 3)->count() : 0) / (float) $total_lpi_approve_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- approve other mf -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 4)->count() : 0 }}
                </td>
                <!-- Percent of other mf -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_other_mfi_approve_application->count() > 0)
                    {{ number_format(((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 4)->count() : 0) / (float) $total_other_mfi_approve_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- approve of cas -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 5)->count() : 0 }}
                </td>
                <!-- Percent of cas -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_cash_approve_application->count() > 0)
                    {{ number_format(((float) ($chan->applications ? $chan->applications->where('status', 2)->where('loan_company_id', 5)->count() : 0) / (float) $total_cash_approve_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- Amount of Follow u -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $followup_application }}
                </td>
                <!-- Percent of follow u -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($followup_application > 0 && $total_follow_up_application->count() > 0)
                    {{ number_format(((float) $followup_application / (float) $total_follow_up_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- amount of rejec -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $reject_application }}
                </td>
                <!-- Percent of rejec -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_reject_application->count() > 0)
                    {{ number_format(((float) $reject_application / (float) $total_reject_application->count()) * 100) }}
                    %
                    @else
                    0 %
                    @endif
                </td>
                <!-- Total -->
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $grand_total_application }}</td>
                <!-- Rating of Approv -->
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($grand_total_application)
                    {{ number_format(($approve_application / $grand_total_application) * 100) }} %
                    @else
                    0 %
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" style="text-align: center; font-family:'KhmerOSbattambang';">{{ __('Total') }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_plan }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    @if ($total_balance_as_at)
                    {{ $total_balance_as_at }}
                    @endif
                </td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_variance)
                    {{ $total_variance }}
                    @endif
                </td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_achieved) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_bbf_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_bbf_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_tk_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_tk_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_lpi_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_lpi_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_other_mfi_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_other_mfi_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_cash_approved }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_cash_approve_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_follow_up }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_follow_up_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_reject }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    {{ number_format($total_reject_percent) }} %
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $total_grand_total }}</td>
                <td style="text-align: center; color: red; font-family:'KhmerOSbattambang';">
                    @if ($total_grand_total)
                    {{ number_format(($total_approved / $total_grand_total) * 100) }} %
                    @else
                    0 %
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>