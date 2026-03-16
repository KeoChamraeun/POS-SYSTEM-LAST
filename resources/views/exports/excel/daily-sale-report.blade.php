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
            border: 1px solid grey;
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
        <tr>
            <th rowspan="4">
            </th>
            <th colspan="23" style="text-align:center;">
                <div style="font-weight: 700; font-size: 14px; font-family: KhmerOS_muollight">
                    <strong>{{ env('APP_HEADER_NAME_KH') }}</strong>
                </div>
            </th>
        </tr>

        <tr>
            <th colspan="23" style="text-align:center;">
                <p>{{ env('APP_HEADER_NAME') }}</p>
            </th>
        </tr>
        <tr>
            <th colspan="23" style="text-align:center;">
                <p style="font-weight: 700; font-family: KhmerOS_muollight">
                    <strong>{{ __('Daily Sale Report') }}</strong>
                </p>
            </th>
        </tr>
        <tr>
            <th colspan="23" style="text-align:center; color:#daad5c;">
                <p style="color: #daad5c;">
                    {{ __('Monthly') }} {{ trans(date('F', strtotime($start_date))) }} {{ __('Year') }}
                    {{ date('Y', strtotime($start_date)) }}
                    ({{ date('d', strtotime($start_date)) . '-' . __(date('F', strtotime($start_date))) . '-' . date('Y', strtotime($start_date)) }})
                    {{ __('to') }}
                    ({{ date('d', strtotime($end_date)) . '-' . __(date('F', strtotime($end_date))) . '-' . date('Y', strtotime($end_date)) }})
                </p>
            </th>
        </tr>
        <thead>
            <tr>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('No.') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('CC Filled Date') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Credit Branch') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Client Name') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Phone Number') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Clients Facebook') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Village') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Commune') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('District') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Province') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Sale Channels') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Agent Name') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Job/ID') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Co Phone Number') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Product Type') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Product/Motor Brand') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Year') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Price') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Name CO/CC Response') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Credit Partner') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Status') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Date Approved / Follow Up') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Reason Rejection') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align:center; ">
                    {{ __('Classification') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $index => $item)
            <tr>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $index + 1 }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ date('d-m-Y', strtotime($item->created_at)) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{$item->shop->operational_area->local_code ?? ''}}
                </td>
                <td style="font-family:'KhmerOSbattambang';">
                    {{ label_translation($item->customer) ?: $item->customer_name_translate }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->customer->phone }} </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $item->customer->client_facebook ?? '' }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ get_translation($item->address->village ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ get_translation($item->address->commune ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ get_translation($item->address->district ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ get_translation($item->address->city ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{label_translation($item->sale_channel?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{$item->agent_name}}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{$item->agent_code}}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->co->phone ?? "" }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->condition }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item->product->brand ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $item->product->year_of_manufacture ?? '' }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ get_money($item->product_price) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->co->name ?? ''}}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{label_translation($item->loan_company ?? '')}}
                </td>
                <?php
                $statusLabels = [
                    '2' => ['label' => __('Approved'), 'color' => '#198754'],
                    '1' => ['label' => __('Follow Up'), 'color' => '#03A9F4'],
                    '0' => ['label' => __('Rejected'), 'color' => '#dc3545'],
                ];
                $status = $statusLabels[$item->status] ?? ['label' => '', 'color' => '#000000'];
                ?>
                <td style="text-align: center; font-family:'KhmerOSbattambang'; color: {{ $status['color'] }};">
                    {{ $status['label'] }}
                </td>
                <td style="text-align: center">
                    <?php
                    $latest_application_activity = $item->application_activity->sortByDesc('id')->first();
                    ?>
                    {{$latest_application_activity?->created_at->format('Y-m-d')}}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    @foreach ($item->application_activity as $item)
                    @if($item->description || $item->reason)
                    {{ $loop->index + 1 }}.
                    @if ($item->reason)
                    {{ label_translation($item->reason) }},
                    @endif
                    @if ($item->description)
                    {{ $item->description }}
                    @endif
                    @endif
                    @endforeach
                </td>
                <td style="text-align: center">
                    {{$latest_application_activity->reason->id ?? ''}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="23" style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ __('No Record Found.!') }}
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>