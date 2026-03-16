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
            font-size: 18px !important;
            color: gray;
            padding: 3px;
            word-wrap: break-word;
            white-space: nowrap;
        }

        th {
            border: 1px solid gray;
            font-size: 18px !important;
            color: gray;
            padding: 3px;
            word-wrap: break-word;
            background: #E2EFDA;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="15" style="text-align:center;">
                    <div style="font-weight: 700; font-size: 14px;">
                        <strong
                            style=" font-weight: 700; font-family: KhmerOS_muollight">{{ env('APP_HEADER_NAME_KH') }}</strong>
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="15" style="text-align:center;">
                    <p style="font-weight: 700; font-family: KhmerOS_muollight">{{ env('APP_HEADER_NAME') }}
                    </p>
                </th>
            </tr>
            <tr>
                <th colspan="15" style="text-align:center;">
                    <p
                        style="text-align:center; font-size: 24px !important; font-family:'KhmerOSbattambang' !important;">
                        {{ __('Sale Summary By Company Report') }}
                    </p>
                </th>
            </tr>
            <tr>
                <th colspan="15" style="text-align:center; color:#daad5c; font-family:'KhmerOSbattambang'; ">
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
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('No.') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Shop Name') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Code') }}
                </th>
                <th colspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Total Sale') }}
                </th>
                <th rowspan="2" class="text-danger"
                    style=" background: #E2EFDA; color: red; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ __('Difference') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Bamboo Finance Plc') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Trop Khnhom PLC') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Pawn Shop 168  Co.,Ltd') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Cash') }}
                </th>
                <th rowspan="2"
                    style=" background: #E2EFDA; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang'; ">
                    {{ __('Other MFI') }}
                </th>
                <th rowspan="2" class="text-primary"
                    style=" background: #E2EFDA; color: blue; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ __('Qty Sale Daily') }}
                </th>
                <th rowspan="2" class="text-primary"
                    style=" background: #E2EFDA; color: blue; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ __('Average Sale Daily') }}
                </th>
                <th rowspan="2" class="text-primary"
                    style=" background: #E2EFDA; color: blue; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ __('#CC') }}
                </th>
                <th rowspan="2" class="text-primary"
                    style=" background: #E2EFDA; color: blue; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ __('Average Per CC') }}
                </th>
            </tr>
            <tr>
                <th class="text-danger"
                    style=" background: #E2EFDA; color: red; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ date('d', strtotime($last_month_end)) . '-' . __(date('F', strtotime($last_month_end))) }}
                </th>
                <th class="text-primary"
                    style=" background: #E2EFDA; color:blue; font-size: 12px; border: 1px solid gray; font-family:'KhmerOSbattambang';">
                    {{ date('d', strtotime($end_date)) . '-' . __(date('F', strtotime($end_date))) }}
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_last_month = 0;
            $total_current_month = 0;
            $total_different = 0;
            $total_bamboo = 0;
            $total_trop = 0;
            $total_lpi = 0;
            $total_cash = 0;
            $total_other_mfi = 0;
            $total_qty_sale_daily = 0;
            $total_average_sale_daily = 0;
            $total_average_qty_sale_daily = 0;
            $total_cash = 0;
            $total_daily_sale = 0;
            $daily_sale = 0;
            $average_qty_sale_daily = 0;
            ?>
            @foreach ($item_sale_by_shops as $i => $item)
            <?php
            $last_month = $item->applications->whereBetween('created_at', [$last_month_start, $last_month_end])
                ->where('shop_id', $item->id)
                ->where('status', 2)
                ->count();

            $current_month = $item->applications->whereBetween('created_at', [$start_date . '00:00:00', $end_date . '23:59:59'])
                ->where('shop_id', $item->id)
                ->where('status', 2)
                ->count();


            $different_sale = abs($last_month - $current_month);
            $daily_sale = $item->applications->whereBetween('created_at', [$today_date . ' 00:00:00', $today_date . ' 23:59:59'])
                ->where('shop_id', $item->id)
                ->where('status', 2)
                ->count();

            $applications = $item->applications->whereBetween('created_at', [$start_date . '00:00:00', $end_date . '23:59:59'])
                ->where('shop_id', $item->id)
                ->where('status', 2);

            $bamboo_count =  $applications->where('loan_company_id', 1)->count();

            $trop_count = $applications->where('loan_company_id', 2)->count();

            $lpi_count = $applications->where('loan_company_id', 3)->count();

            $other_mfi_count = $applications->where('loan_company_id', 4)->count();

            $cash_count = $applications->whereIn('loan_company_id', [5])
                ->count();
            $daily_sales_count = $item->applications->where('created_at', $today_date)->count();

            $average_qty_sale_daily = !empty($day_in_current_month) ? round((float) $current_month / (float) $day_in_current_month, 3) : 0;
            $total_average_qty_sale_daily = !empty($day_in_current_month) ? round((float) $total_current_month / (float) $day_in_current_month, 3) : 0;

            $total_daily_sale += $daily_sale;
            $total_last_month += $last_month;
            $total_current_month += $current_month;
            $total_different += $different_sale;
            $total_bamboo += $bamboo_count;
            $total_trop += $trop_count;
            $total_lpi += $lpi_count;
            $total_other_mfi += $other_mfi_count;
            $total_cash += $cash_count;
            ?>
            <tr>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">{{ ++$i }}</td>
                <td class="text-start" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item) }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $item->operational_area->local_code }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">{{ $last_month }}</td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang';">{{ $current_month }}
                </td>
                <td class="text-center text-danger"
                    style="color: red; font-size:12px; font-family:'KhmerOSbattambang';">({{ $different_sale }})
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $bamboo_count }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $trop_count }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $lpi_count }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $other_mfi_count }}
                </td>
                <td class="text-center" style="font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $cash_count }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ $daily_sale }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ number_format($average_qty_sale_daily, 2) }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ '-' }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang';">
                    {{ '-' }}
                </td>
            </tr>
            @endforeach
            <tr style="background-color: #E2EFDA; font-size: 12px; font-family:'KhmerOSbattambang';">
                <td class="text-center" colspan="3"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; text-align:center; border: 1px solid gray;">
                    {{ __('Total') }}
                </td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_last_month }}
                </td>
                <td class="text-center"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_current_month }}
                </td>
                <td class="text-center text-danger"
                    style="color: red; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    ({{ $total_different }})</td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_bamboo }}
                </td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_trop }}
                </td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_lpi }}
                </td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_other_mfi }}
                </td>
                <td class="text-center"
                    style="font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_cash }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ $total_daily_sale }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ number_format($total_average_qty_sale_daily, 2) }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ '-' }}
                </td>
                <td class="text-center text-primary"
                    style="color: blue; font-size: 12px; font-family:'KhmerOSbattambang'; background: #E2EFDA; border: 1px solid gray;">
                    {{ '-' }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>