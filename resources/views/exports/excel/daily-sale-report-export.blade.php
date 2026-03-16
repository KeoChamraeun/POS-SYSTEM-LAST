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
            <th colspan="20" style="text-align:center;">
                <div style="font-weight: 700; font-size: 14px; font-family: KhmerOS_muollight">
                    <strong>{{ env('APP_HEADER_NAME_KH') }}</strong>
                </div>
            </th>
        </tr>

        <tr>
            <th colspan="20" style="text-align:center;">
                <p>{{ env('APP_HEADER_NAME') }}</p>
            </th>
        </tr>
        <tr>
            <th colspan="20" style="text-align:center;">
                <p style="font-weight: 700; font-family: KhmerOS_muollight">
                    <strong>{{ __('Daily Sale Report') }}</strong>
                </p>
            </th>
        </tr>
        <tr>
            <th colspan="20" style="text-align:center; color:#daad5c;">
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
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('No.') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Date') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Shop Name') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Customer Name') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Phone Number') }}
                </th>
                <th colspan="4"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang'; text-align: center;">
                    {{ __('Customer Address') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Guarantor Name') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Guarantor Phone') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Condition') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Brand') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Year') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Price') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Respond By') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Status') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Area Code') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Loan Company') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Date Follow Up') }}
                </th>
                <th rowspan="2"
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Reason') }}
                </th>
            </tr>
            <tr>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Village') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('Commune') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('District') }}
                </th>
                <th
                    style=" background: #b8cae6; font-size: 12px; border: 1px solid gray; font-family: 'KhmerOSBattambang';">
                    {{ __('City') }}
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
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ label_translation($item->shop) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item->customer) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->customer->phone ?? '-' }}
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
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ guarantor_translation($item) }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->guarantor_phone ?? '-' }}
                </td>
                {{-- <!--<td>{{ $item->product_title ?? '-' }}</td>--> --}}
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ __($item->condition ?? '') }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item->product->brand ?? '') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $item->product->year_of_manufacture ?? '' }}
                </td>
                <td class="text-danger text-end text-nowrap">{{ get_money($item->product_price) }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">{{ $item->respond_by }}</td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    @if ($item->status == '2')
                    <span class="text-success">{{ __('Approved') }}</span>
                    @elseif($item->status == '1')
                    <span class="text-info">{{ __('Follow Up') }}</span>
                    @elseif($item->status == '0')
                    <span class="text-danger">{{ __('Rejected') }}</span>
                    @endif
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $item->branch->operational_area->local_code ?? '' }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ label_translation($item->loan_company) }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    {{ $item->updated_at->format('Y-m-d') }}
                </td>
                <td style="text-align: center; font-family:'KhmerOSbattambang';">
                    @foreach ($item->application_activity as $item)
                    @if ($item->reason)
                    {{ label_translation($item->reason) }}
                    @endif
                    @if ($item->reason_text)
                    {{ $item->reason_text }}
                    @endif
                    @endforeach
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="22" class="text-center">{{ __('No Record Found.!') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>