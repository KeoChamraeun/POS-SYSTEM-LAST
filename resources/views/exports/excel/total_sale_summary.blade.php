<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Total Sale Summary Report') }}</title>
</head>

<body>
    <div class="table-wrapper">
        <table class="table table-bordered table-striped">
            <tr>
                <th colspan="36" style="text-align:center;">
                    <div style="font-weight: 700; font-family: KhmerOS_muollight">
                        <strong>{{ env('APP_HEADER_NAME_KH') }}</strong>
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan="36" style="text-align:center;">
                    <p>{{ env('APP_HEADER_NAME') }}</p>
                </th>
            </tr>
            <tr>
                <th colspan="36" style="text-align:center;">
                    <p style="font-weight: 700; font-family: KhmerOS_muollight">
                        <strong>{{ __('Total Sale Summary Report') }}</strong>
                    </p>
                </th>
            </tr>
            <tr>
                <th colspan="36" style="text-align:center; color:#daad5c;">
                    <p style="color: #daad5c; font-family:'KhmerOSbattambang' !important;">
                        {{ __('Monthly') }} {{ trans(date('F', strtotime($start_date))) }} {{ __('Year') }}
                        {{ date('Y', strtotime($start_date)) }}
                        ({{ date('d', strtotime($start_date)) . '-' . __(date('F', strtotime($start_date))) . '-' . date('Y', strtotime($start_date)) }})
                        {{ __('to') }}
                        ({{ date('d', strtotime($end_date)) . '-' . __(date('F', strtotime($end_date))) . '-' . date('Y', strtotime($end_date)) }})
                    </p>
                </th>
            </tr>
            <thead>
                <tr class="table-header">
                    <th rowspan="2" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('No.') }}
                    </th>
                    <th rowspan="2" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Shop Manager') }}
                    </th>
                    <th rowspan="2"
                        style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Name Shop') }}
                    </th>
                    <th rowspan="2" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Local') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Field') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Partner Shop') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Agency') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('In House') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('121 Digital Online') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Online Agency') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Qty Total') }}
                    </th>
                    <th colspan="4" style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Target') }}
                    </th>
                </tr>
                <tr class="table-header">
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style=" background: #9dea81; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Approved') }}
                    </th>
                    <th style=" background:  #939492; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Follow Up') }}
                    </th>
                    <th style=" background: #e40b0b; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Reject') }}
                    </th>
                    <th style=" background: #f3ef9f; font-size: 10px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                        {{ __('Application') }}
                    </th>
                    <th style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('# Plan') }}</th>
                    <th style="text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;">%</th>
                    <th style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('Grade') }}</th>
                    <th style="font-family:'KhmerOSbattambang'; border: 1px solid gray;">{{ __('Rank') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_approve_field = 0;
                $total_approve_partner = 0;
                $total_approve_agency = 0;
                $total_approve_inhouse = 0;
                $total_approve_digital = 0;
                $total_approve_online = 0;

                $total_followup_field = 0;
                $total_followup_partner = 0;
                $total_followup_agency = 0;
                $total_followup_inhouse = 0;
                $total_followup_digital = 0;
                $total_followup_online = 0;

                $total_reject_field = 0;
                $total_reject_partner = 0;
                $total_reject_agency = 0;
                $total_reject_inhouse = 0;
                $total_reject_digital = 0;
                $total_reject_online = 0;

                $total_application_field = 0;
                $total_application_partner = 0;
                $total_application_agency = 0;
                $total_application_inhouse = 0;
                $total_application_digital = 0;
                $total_application_online = 0;

                $total_approve_all_channels = 0;
                $total_followup_all_channels = 0;
                $total_reject_all_channels = 0;

                $total_plan_sale_all_shops = 0;
                $total_percent_all_shops = 0;
                $total_grade = 0;
                $total_applications_all_shops = 0;
                $total_approved_by_shop = 0;
                ?>
                @foreach ($shops as $rank => $item)
                <?php
                $plan_sale = App\Models\SaleTargetByShop::where('shop_id', $item->id)->where('month', $this_month)->first();
                $total_plan_sale_all_shops += $plan_sale->target_sale ?? 0;

                $total_percent_all_shops = $total_plan_sale_all_shops != 0 ? ($total_approve_all_channels / $total_plan_sale_all_shops) * 100 : 0;
                $all_channels = $item
                    ->applications()
                    ->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6]);

                $total_approve_field += $item->applications()->where('sale_channel_id', 1)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_approve_partner += $item->applications()->where('sale_channel_id', 2)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_approve_agency += $item->applications()->where('sale_channel_id', 3)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_approve_inhouse += $item->applications()->where('sale_channel_id', 4)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_approve_digital += $item->applications()->where('sale_channel_id', 5)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_approve_online += $item->applications()->where('sale_channel_id', 6)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();

                $total_followup_field += $item->applications()->where('sale_channel_id', 1)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_followup_partner += $item->applications()->where('sale_channel_id', 2)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_followup_agency += $item->applications()->where('sale_channel_id', 3)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_followup_inhouse += $item->applications()->where('sale_channel_id', 4)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_followup_digital += $item->applications()->where('sale_channel_id', 5)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_followup_online += $item->applications()->where('sale_channel_id', 6)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count();

                $total_reject_field += $item->applications()->where('sale_channel_id', 1)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_reject_partner += $item->applications()->where('sale_channel_id', 2)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_reject_agency += $item->applications()->where('sale_channel_id', 3)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_reject_inhouse += $item->applications()->where('sale_channel_id', 4)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_reject_digital += $item->applications()->where('sale_channel_id', 5)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_reject_online += $item->applications()->where('sale_channel_id', 6)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count();

                $total_application_field += $item->applications()->where('sale_channel_id', 1)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_application_partner += $item->applications()->where('sale_channel_id', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_application_agency += $item->applications()->where('sale_channel_id', 3)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_application_inhouse += $item->applications()->where('sale_channel_id', 4)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_application_digital += $item->applications()->where('sale_channel_id', 5)->whereBetween('created_at', [$start_date, $end_date])->count();
                $total_application_online += $item->applications()->where('sale_channel_id', 6)->whereBetween('created_at', [$start_date, $end_date])->count();

                $total_approve_all_channels += $all_channels
                    ->where('status', 2)
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->count();

                $total_followup_all_channels += $item->applications()
                    ->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where('status', 1)
                    ->count();

                $total_reject_all_channels +=  $item->applications()
                    ->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->where('status', 0)
                    ->count();

                $total_applications_all_shops += $item
                    ->applications()
                    ->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])
                    ->whereBetween('created_at', [$start_date, $end_date])
                    ->count();

                $total_approved_by_shop = $item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count();
                ?>
                <tr>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $rank + 1 }}</td>
                    <td style="text-align: center; min-width: 200px; font-family:'KhmerOSbattambang';">{{ $item->owner}} </td>
                    <td style="text-align: left; min-width: 300px; font-family:'KhmerOSbattambang';">{{label_translation($item)}} </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->operational_area->local_code ?? ''  }}</td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 1)->where('status',2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 1)->where('status',1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 1)->where('status',0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 2)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 2)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 2)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 3)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 3)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 3)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 3)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 4)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 4)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 4)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 4)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 5)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 5)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 5)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 5)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 6)->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 6)->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 6)->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->where('sale_channel_id', 6)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    {{-- Total Application --}}
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->where('status', 2)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->where('status', 1)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->where('status', 0)->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->whereBetween('created_at', [$start_date, $end_date])->count() }}
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        @if($plan_sale)
                        {{$plan_sale->target_sale ?? 0 }}
                        @endif
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang'; color: red;">
                        @if($plan_sale)
                        {{ number_format(($item->applications()->whereIn('sale_channel_id', [1, 2, 3, 4, 5, 6])->where('status', 2)->count() /$plan_sale->target_sale ?? 0) *100) }}
                        %
                        @endif
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        @if($plan_sale)
                        {{get_grade($total_approved_by_shop, $plan_sale->target_sale)}}
                        @endif
                    </td>
                    <td style="text-align: center; font-family:'KhmerOSbattambang';">
                        {{ $rank + 1 }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-center"
                        style="font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                        {{ __('Subtotal') }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_field }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_field }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_field }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_field }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_partner }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_partner }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_partner }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_partner }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_agency }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_agency }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_agency }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_agency }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_inhouse }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_inhouse }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_inhouse }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_inhouse }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_digital }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_digital }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_digital }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_digital }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_online }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_online }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_online }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_application_online }}
                    </td>
                    <td style=" background: #9dea81; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_approve_all_channels }}
                    </td>
                    <td style=" background:  #939492; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_followup_all_channels }}
                    </td>
                    <td style=" background: #e40b0b; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_reject_all_channels }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_applications_all_shops }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{ $total_plan_sale_all_shops }}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray; color:#e40b0b;"
                        class="text-center">
                        {{ $total_plan_sale_all_shops > 0 ? number_format(($total_approve_all_channels / $total_plan_sale_all_shops) * 100) : 0 }}%
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                        {{get_grade($total_approve_all_channels, $total_plan_sale_all_shops)}}
                    </td>
                    <td style=" background: #f3ef9f; font-size: 12px; text-align: center; font-family:'KhmerOSbattambang'; border: 1px solid gray;"
                        class="text-center">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>