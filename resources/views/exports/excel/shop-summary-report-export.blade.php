<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Sales Performance Report') }}</title>
</head>
<style>
    table,
    td {
        font-family: 'KhmerOSbattambang';
        border: 1px solid gray;

    }

    th {
        font-family: 'KhmerOSbattambang';
        border: 1px solid gray;

    }
</style>

<body>
    <table class="table table-bordered table-striped">
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
                <p style="text-align:center; font-size: 24px !important; font-family:'KhmerOSbattambang' !important;">
                    {{ __('Total Summary of Shop Performance Report') }}
                </p>
            </th>
        </tr>
        <tr>
            <th colspan="24" style="text-align:center; color:#daad5c; font-family:'KhmerOSbattambang'; ">
                <p style="color: #daad5c; font-family:'KhmerOSbattambang';">
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
                <th rowspan="2" style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">No
                </th>
                <th rowspan="2" class="text-center"
                    style="min-width: 200px; background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Shop Manager') }}
                </th>
                <th rowspan="2" class="text-center"
                    style="min-width: 300px; background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Name Shop') }}
                </th>
                <th rowspan="2" style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Local Code') }}
                </th>
                <th colspan="4" class="text-center"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    Partner Shop
                </th>
                <th colspan="4" class="text-center"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    Shop_Manager
                </th>
                <th colspan="4" class="text-center"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    Client Walk In
                </th>
                <th colspan="4" class="text-center"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    FB Page Shop
                </th>
                <th colspan="4" class="text-center"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Qty Total') }}
                </th>
            </tr>
            <tr class="table-header">
                <th class="vertical-text approved"
                    style="background: #85e29b; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th class="vertical-text follow-up"
                    style="background: #cdcccb; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow Up') }}
                </th>
                <th class="vertical-text reject"
                    style="background: #dc3545; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Reject') }}
                </th>
                <th class="vertical-text application"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Application') }}
                </th>
                <th class="vertical-text approved"
                    style="background: #85e29b; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th class="vertical-text follow-up"
                    style="background: #cdcccb; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow Up') }}
                </th>
                <th class="vertical-text reject"
                    style="background: #dc3545; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Reject') }}
                </th>
                <th class="vertical-text application"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Application') }}
                </th>
                <th class="vertical-text approved"
                    style="background: #85e29b; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th class="vertical-text follow-up"
                    style="background: #cdcccb; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow Up') }}
                </th>
                <th class="vertical-text reject"
                    style="background: #dc3545; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Reject') }}
                </th>
                <th class="vertical-text application"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Application') }}
                </th>
                <th class="vertical-text approved"
                    style="background: #85e29b; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th class="vertical-text follow-up"
                    style="background: #cdcccb; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow Up') }}
                </th>
                <th class="vertical-text reject"
                    style="background: #dc3545; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Reject') }}
                </th>
                <th class="vertical-text application"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Application') }}
                </th>
                <th class="vertical-text approved"
                    style="background: #85e29b; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Approved') }}
                </th>
                <th class="vertical-text follow-up"
                    style="background: #cdcccb; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Follow Up') }}
                </th>
                <th class="vertical-text reject"
                    style="background: #dc3545; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Reject') }}
                </th>
                <th class="vertical-text application"
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray;">
                    {{ __('Application') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_approved_applications = 0;
            $total_follow_up_applications = 0;
            $total_reject_applications = 0;
            $total_count_applications = 0;

            $approved_applications = 0;
            $follow_up_applications = 0;
            $reject_applications = 0;
            $total_applications = 0;

            $count_partner_applications = 0;
            $count_owner_applications = 0;
            $count_walkin_applications = 0;
            $count_fb_applications = 0;
            $count_all_channel_approve_applications = 0;
            $count_all_channel_follow_up_applications = 0;
            $count_all_channel_reject_applications = 0;
            $count_all_channel_applications = 0;

            $total_partner_applications = 0;
            $total_owner_applications = 0;
            $total_walkin_applications = 0;
            $total_fb_applications = 0;
            $total_all_channel_approve_applications = 0;
            $total_all_channel_follow_up_applications = 0;
            $total_all_channel_reject_applications = 0;
            $total_all_channel_applications = 0;

            $count_approve_partner = 0;
            $count_follow_up_partner = 0;
            $count_reject_partner = 0;

            $total_approve_partner = 0;
            $total_follow_up_partner = 0;
            $total_reject_partner = 0;

            $count_approve_owner = 0;
            $count_follow_up_owner = 0;
            $count_reject_owner = 0;

            $total_approve_owner = 0;
            $total_follow_up_owner = 0;
            $total_reject_owner = 0;

            $count_approve_walkin = 0;
            $count_follow_up_walkin = 0;
            $count_reject_walkin = 0;

            $total_approve_walkin = 0;
            $total_follow_up_walkin = 0;
            $total_reject_walkin = 0;

            $count_approve_fb = 0;
            $count_follow_up_fb = 0;
            $count_reject_fb = 0;

            $total_approve_fb = 0;
            $total_follow_up_fb = 0;
            $total_reject_fb = 0;

            ?>
            @if ($item_sale_by_shops->isEmpty())
            <tr>
                <td colspan="24" class="text-center">{{ __('No Record Found.!') }}</td>
            </tr>
            @else
            @foreach ($item_sale_by_shops as $key => $item)
            <?php
            $applications_all_channels = $item->applications()
                ->where('sale_channel_id', [2, 7, 8, 9]);

            $approved_applications = $applications_all_channels
                ->where('status', 2)
                ->count();

            $follow_up_applications = $applications_all_channels
                ->where('status', 1)
                ->count();

            $reject_applications = $applications_all_channels
                ->where('status', 0)
                ->count();

            $total_applications = $applications_all_channels->count();
            $total_approved_applications += $approved_applications;
            $total_follow_up_applications += $follow_up_applications;
            $total_reject_applications += $reject_applications;
            $total_count_applications += $total_applications;

            //partner shop channel
            $partner_shop_channel = $item->applications()->where('sale_channel_id', 2);
            $count_approve_partner = $partner_shop_channel->where('status', 2)->count();
            $total_approve_partner += $count_approve_partner;
            $count_follow_up_partner = $item->applications()->where('sale_channel_id', 2)->where('status', 1)->count();
            $total_follow_up_partner += $count_follow_up_partner;
            $count_reject_partner = $item->applications()->where('sale_channel_id', 2)->where('status', 0)->count();
            $total_reject_partner += $count_reject_partner;
            $count_partner_applications = $partner_shop_channel->count();
            $total_partner_applications += $item->applications()->where('sale_channel_id', 2)->count();

            //owner shop channel
            $owner_channel = $item->applications()->where('sale_channel_id', 9);
            $count_approve_owner = $owner_channel->where('status', 2)->count();
            $total_approve_owner += $count_approve_owner;
            $count_follow_up_owner = $item->applications()->where('sale_channel_id', 9)->where('status', 1)->count();;
            $total_follow_up_owner += $count_follow_up_owner;
            $count_reject_owner = $item->applications()->where('sale_channel_id', 9)->where('status', 0)->count();;
            $total_reject_owner += $count_reject_owner;
            $count_owner_applications = $owner_channel->count();
            $total_owner_applications += $item->applications()->where('sale_channel_id', 9)->count();

            //walking channel
            $walkin_channel = $item->applications()->where('sale_channel_id', 7);
            $count_approve_walkin = $walkin_channel->where('status', 2)->count();
            $total_approve_walkin += $count_approve_walkin;
            $count_follow_up_walkin = $item->applications()->where('sale_channel_id', 7)->where('status', 1)->count();
            $total_follow_up_walkin += $walkin_channel->count();
            $count_reject_walkin = $item->applications()->where('sale_channel_id', 7)->where('status', 0)->count();
            $total_reject_walkin += $count_reject_walkin;
            $count_walkin_applications = $walkin_channel->count();
            $total_walkin_applications += $item->applications()->where('sale_channel_id', 7)->count();

            //fb channel
            $fb_channel = $item->applications()->where('sale_channel_id', 8);
            $count_approve_fb = $fb_channel->where('status', 2)->count();
            $total_approve_fb += $count_approve_fb;
            $count_follow_up_fb = $item->applications()->where('sale_channel_id', 8)->where('status', 1)->count();
            $total_follow_up_fb += $count_follow_up_fb;
            $count_reject_fb = $item->applications()->where('sale_channel_id', 8)->where('status', 0)->count();
            $total_reject_fb += $count_reject_fb;
            $count_fb_applications = $fb_channel->count();
            $total_fb_applications += $item->applications()->where('sale_channel_id', 8)->count();

            $total_all_channel_approve_applications += $item->applications()
                ->whereIn('sale_channel_id', [2, 7, 8, 9])
                ->where('status', 2)
                ->count();

            $total_all_channel_follow_up_applications += $item->applications()
                ->whereIn('sale_channel_id', [2, 7, 8, 9])
                ->where('status', 1)
                ->count();

            $total_all_channel_reject_applications += $item->applications()
                ->whereIn('sale_channel_id', [2, 7, 8, 9])
                ->where('status', 0)
                ->count();

            $total_all_channel_applications += $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->whereIn('status', [1, 2, 0])->count()

            ?>
            <tr class="">
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $key + 1 }}</td>
                <td style="text-align: center; min-width: 200px; font-family:'KhmerOSbattambang';">
                    {{ $item->owner}}
                </td>
                <td style="text-align: left; min-width: 300px; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->abbreviation ?? '-' }}</td>
                {{-- partnershop --}}
                <td class="text-center" style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 2)->where('status', 2)->count() }}
                </td>
                <td class="text-center" style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 2)->where('status', 1)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 2)->where('status', 0)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 2)->count() }}
                </td>
                {{-- owner --}}
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 9)->where('status', 2)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 9)->where('status', 1)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 9)->where('status', 0)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 9)->count() }}
                </td>
                {{-- Walk in --}}
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 7)->where('status', 2)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 7)->where('status', 1)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 7)->where('status', 0)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 7)->count() }}
                </td>
                {{-- Facebook page --}}
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 8)->where('status', 2)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 8)->where('status', 1)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 8)->where('status', 0)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->where('sale_channel_id', 8)->count() }}
                </td>
                {{-- Total application --}}
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 2)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 1)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 0)->count() }}
                </td>
                <td style="font-family:'KhmerOSbattambang'; text-align:center;">
                    {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->whereIn('status', [1, 2, 0])->count() }}
                </td>
            </tr>
            @endforeach
            <tr class="subtotal-row">
                <td colspan="4"
                    style="text-align: right; background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ __('Subtotal') }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_approve_partner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_follow_up_partner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_reject_partner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_partner_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_approve_owner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_follow_up_owner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_reject_owner }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_owner_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_approve_walkin }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_follow_up_walkin }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_reject_walkin }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_walkin_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_approve_fb }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_follow_up_fb }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_reject_fb }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_fb_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_all_channel_approve_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_all_channel_follow_up_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_all_channel_reject_applications }}
                </td>
                <td
                    style="background: #f0e6ca; font-family:'KhmerOSbattambang'; border: 1px solid gray; text-align:center;">
                    {{ $total_all_channel_applications }}
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</body>

</html>