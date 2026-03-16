<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Sales Performance Report') }}</title>
</head>

<body>
    <table class="table table-bordered table-striped">
        <thead>
            <tr style="border: 1px solid transparent; text-align:center;">
                <th colspan="24" style="text-align:center;">
                    <div style="font-weight: 700; font-family: KhmerOS_muollight; font-size: 15px;">
                        <strong>{{ env('APP_HEADER_NAME_KH') }}</strong>
                    </div> <br>
                    <div style="font-size: large;">
                        <p>{{ env('APP_HEADER_NAME') }}</p>
                    </div> <br>
                    <div style="font-weight: 700; font-family: KhmerOS_muollight">
                        <strong
                            style="text-align: center;">{{ __('Total Summary of Shop Performance Report') }}</strong>
                    </div> <br>
                    <div style="color: #daad5c;">
                        {{ __('Monthly') }} {{ trans(date('F', strtotime($start_date))) }} {{ __('Year') }}
                        {{ date('Y', strtotime($start_date)) }}
                        ({{ date('d', strtotime($start_date)) . '-' . __(date('F', strtotime($start_date))) . '-' . date('Y', strtotime($start_date)) }})
                        {{ __('To Date') }}
                        ({{ date('d', strtotime($end_date)) . '-' . __(date('F', strtotime($end_date))) . '-' . date('Y', strtotime($end_date)) }})
                    </div>
                </th>
            </tr>
            <tr class="table-header">
                <th rowspan="2" style="background: #f0e6ca;">No</th>
                <th rowspan="2" class="text-center" style="min-width: 200px; background: #f0e6ca;">
                    {{ __('Shop Manager') }}</th>
                <th rowspan="2" class="text-center" style="min-width: 300px; background: #f0e6ca;">
                    {{ __('Name Shop') }}</th>
                <th rowspan="2" style="background: #f0e6ca;">{{ __('Local') }}</th>
                <th colspan="4" class="text-center" style="background: #f0e6ca;">{{ __('Partner Shop') }}</th>
                <th colspan="4" class="text-center" style="background: #f0e6ca;">{{ __('Shop_Manager') }}</th>
                <th colspan="4" class="text-center" style="background: #f0e6ca;">{{ __('Client Walk In') }}</th>
                <th colspan="4" class="text-center" style="background: #f0e6ca;">{{ __('FB Page Shop') }}</th>
                <th colspan="4" class="text-center" style="background: #f0e6ca;">{{ __('Qty Total') }}</th>
            </tr>
            <tr class="table-header">
                <th class="vertical-text approved" style="background: #85e29b;">{{ __('Approved') }}</th>
                <th class="vertical-text follow-up" style="background: #cdcccb;">{{ __('Follow Up') }}</th>
                <th class="vertical-text reject" style="background: #dc3545;">{{ __('Reject') }}</th>
                <th class="vertical-text application" style="background: #f0e6ca;">{{ __('Application') }}</th>
                <th class="vertical-text approved" style="background: #85e29b;">{{ __('Approved') }}</th>
                <th class="vertical-text follow-up" style="background: #cdcccb;">{{ __('Follow Up') }}</th>
                <th class="vertical-text reject" style="background: #dc3545;">{{ __('Reject') }}</th>
                <th class="vertical-text application" style="background: #f0e6ca;">{{ __('Application') }}</th>
                <th class="vertical-text approved" style="background: #85e29b;">{{ __('Approved') }}</th>
                <th class="vertical-text follow-up" style="background: #cdcccb;">{{ __('Follow Up') }}</th>
                <th class="vertical-text reject" style="background: #dc3545;">{{ __('Reject') }}</th>
                <th class="vertical-text application" style="background: #f0e6ca;">{{ __('Application') }}</th>
                <th class="vertical-text approved" style="background: #85e29b;">{{ __('Approved') }}</th>
                <th class="vertical-text follow-up" style="background: #cdcccb;">{{ __('Follow Up') }}</th>
                <th class="vertical-text reject" style="background: #dc3545;">{{ __('Reject') }}</th>
                <th class="vertical-text application" style="background: #f0e6ca;">{{ __('Application') }}</th>
                <th class="vertical-text approved" style="background: #85e29b;">{{ __('Approved') }}</th>
                <th class="vertical-text follow-up" style="background: #cdcccb;">{{ __('Follow Up') }}</th>
                <th class="vertical-text reject" style="background: #dc3545;">{{ __('Reject') }}</th>
                <th class="vertical-text application" style="background: #f0e6ca;">{{ __('Application') }}</th>
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
            @if ($shops->isEmpty())
                <tr>
                    <td colspan="24" class="text-center">{{ __('No Record Found.!') }}</td>
                </tr>
            @else
                @foreach ($shops as $key => $item)
                    <?php
                    $approved_applications = $item
                        ->applications()
                        ->where('status', 2)
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    $follow_up_applications = $item
                        ->applications()
                        ->where('status', 1)
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    $reject_applications = $item
                        ->applications()
                        ->where('status', 0)
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    $total_applications = $item
                        ->applications()
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    $total_approved_applications += $approved_applications;
                    $total_follow_up_applications += $follow_up_applications;
                    $total_reject_applications += $reject_applications;
                    $total_count_applications += $total_applications;
                    
                    $count_approve_partner = $item->applications()->where('sale_channel_id', 2)->where('status', 2)->count();
                    $total_approve_partner += $count_approve_partner;
                    
                    $count_follow_up_partner = $item->applications()->where('sale_channel_id', 2)->where('status', 1)->count();
                    $total_follow_up_partner += $count_follow_up_partner;
                    
                    $count_reject_partner = $item->applications()->where('sale_channel_id', 2)->where('status', 0)->count();
                    $total_reject_partner += $count_reject_partner;
                    $count_partner_applications = $item->applications()->where('sale_channel_id', 2)->count();
                    $total_partner_applications += $count_partner_applications;
                    
                    $count_approve_owner = $item->applications()->where('sale_channel_id', 9)->where('status', 2)->count();
                    $total_approve_owner += $count_approve_owner;
                    
                    $count_follow_up_owner = $item->applications()->where('sale_channel_id', 9)->where('status', 1)->count();
                    $total_follow_up_owner += $count_follow_up_owner;
                    
                    $count_reject_owner = $item->applications()->where('sale_channel_id', 9)->where('status', 0)->count();
                    $total_reject_owner += $count_reject_owner;
                    $count_owner_applications = $item->applications()->where('sale_channel_id', 9)->count();
                    $total_owner_applications += $count_owner_applications;
                    
                    $count_approve_walkin = $item->applications()->where('sale_channel_id', 7)->where('status', 2)->count();
                    $total_approve_walkin += $count_approve_walkin;
                    
                    $count_follow_up_walkin = $item->applications()->where('sale_channel_id', 7)->where('status', 1)->count();
                    $total_follow_up_walkin += $count_follow_up_walkin;
                    
                    $count_reject_walkin = $item->applications()->where('sale_channel_id', 7)->where('status', 0)->count();
                    $total_reject_walkin += $count_reject_walkin;
                    $count_walkin_applications = $item->applications()->where('sale_channel_id', 7)->count();
                    $total_walkin_applications += $count_walkin_applications;
                    
                    $count_approve_fb = $item->applications()->where('sale_channel_id', 8)->where('status', 2)->count();
                    $total_approve_fb += $count_approve_fb;
                    
                    $count_follow_up_fb = $item->applications()->where('sale_channel_id', 8)->where('status', 1)->count();
                    $total_follow_up_fb += $count_follow_up_fb;
                    
                    $count_reject_fb = $item->applications()->where('sale_channel_id', 8)->where('status', 0)->count();
                    $total_reject_fb += $count_reject_fb;
                    $count_fb_applications = $item->applications()->where('sale_channel_id', 8)->count();
                    $total_fb_applications += $count_fb_applications;
                    
                    $total_all_channel_approve_applications += $item
                        ->applications()
                        ->whereIn('sale_channel_id', [2, 8, 9, 7])
                        ->where('status', 2)
                        ->count();
                    $total_all_channel_follow_up_applications += $item
                        ->applications()
                        ->whereIn('sale_channel_id', [2, 8, 9, 7])
                        ->where('status', 1)
                        ->count();
                    $total_all_channel_reject_applications += $item
                        ->applications()
                        ->whereIn('sale_channel_id', [2, 8, 9, 7])
                        ->where('status', 0)
                        ->count();
                    
                    $total_applications += $item
                        ->applications()
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    $total_applications += $item
                        ->applications()
                        ->where('sale_channel_id', [2, 7, 8, 9])
                        ->count();
                    
                    $total_all_channel_applications += $item
                        ->applications()
                        ->whereIn('sale_channel_id', [2, 8, 9, 7])
                        ->whereIn('status', [1, 2, 0])
                        ->count();
                    
                    ?>
                    <tr class="">
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td style="text-align: center; min-width: 200px;">{{ $item->owner ?? '-' }}</td>
                        <td style="text-align: left; min-width: 300px;">{{ label_translation($item) }}</td>
                        <td style="text-align: center;">{{ $item->abbreviation ?? '-' }}</td>
                        {{-- partnershop --}}
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 2)->where('status', 2)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 2)->where('status', 1)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 2)->where('status', 0)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 2)->count() }}
                        </td>
                        {{-- owner --}}
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 9)->where('status', 2)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 9)->where('status', 1)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 9)->where('status', 0)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 9)->count() }}
                        </td>
                        {{-- Walk in --}}
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 7)->where('status', 2)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 7)->where('status', 1)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 7)->where('status', 0)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 7)->count() }}
                        </td>
                        {{-- Facebook page --}}
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 8)->where('status', 2)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 8)->where('status', 1)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 8)->where('status', 0)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->where('sale_channel_id', 8)->count() }}
                        </td>
                        {{-- Total application --}}
                        <td class="text-center">
                            {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 2)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 1)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->where('status', 0)->count() }}
                        </td>
                        <td class="text-center">
                            {{ $item->applications()->whereIn('sale_channel_id', [2, 8, 9, 7])->whereIn('status', [1, 2, 0])->count() }}
                        </td>
                    </tr>
                @endforeach
                <tr class="subtotal-row">
                    <td colspan="4" style="text-align: right; background: #f0e6ca;">{{ __('Sub Total') }}
                    </td>
                    <td style="background: #f0e6ca;">{{ $total_approve_partner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_follow_up_partner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_reject_partner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_partner_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_approve_owner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_follow_up_owner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_reject_owner }}</td>
                    <td style="background: #f0e6ca;">{{ $total_owner_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_approve_walkin }}</td>
                    <td style="background: #f0e6ca;">{{ $total_follow_up_walkin }}</td>
                    <td style="background: #f0e6ca;">{{ $total_reject_walkin }}</td>
                    <td style="background: #f0e6ca;">{{ $total_walkin_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_approve_fb }}</td>
                    <td style="background: #f0e6ca;">{{ $total_follow_up_fb }}</td>
                    <td style="background: #f0e6ca;">{{ $total_reject_fb }}</td>
                    <td style="background: #f0e6ca;">{{ $total_fb_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_all_channel_approve_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_all_channel_follow_up_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_all_channel_reject_applications }}</td>
                    <td style="background: #f0e6ca;">{{ $total_all_channel_applications }}</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>

</html>
