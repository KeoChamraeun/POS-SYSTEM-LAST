<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sale Summary Report</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr style="border: 1px solid transparent; text-align:center;">
                <th colspan="13" style="text-align:center" class="title-header ">
                    <h5 style="font-weight: 700; font-family: KhmerOS_muollight"><strong>{{__('Sale Summary Report')}}</strong></h5>
                </th>
            </tr>
            <tr>
                <th style="text-align: center; background-color: #b0abab;">N.o</th>
                <th style="text-align: center; background-color: #b0abab;">Name Shop</th>
                <th style="text-align: center; background-color: #b0abab;">Code</th>
                <th colspan="2" style="text-align: center; background-color: #b0abab;">Total Sale</th>
                <th style="text-align: center; background-color: #b0abab;">Difference</th>
                <th style="text-align: center; background-color: #b0abab;">Bamboo</th>
                <th style="text-align: center; background-color: #b0abab;">Trop Khnom</th>
                <th style="text-align: center; background-color: #b0abab;">LPI 168</th>
                <th style="text-align: center; background-color: #b0abab;">Cash</th>
                <th style="text-align: center; background-color: #b0abab;">OTHER MFI</th>
                <th style="text-align: center; background-color: #b0abab;">Qty Sale Daily</th>
                <th style="text-align: center; background-color: #b0abab;">Average Sale Daily</th>
            </tr>
            <tr>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;">Last Month</th>
                <th style="text-align: center; background-color: #b0abab;">This Month</th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
                <th style="text-align: center; background-color: #b0abab;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salesData as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name_shop }}</td>
                <td>{{ $data->local_code }}</td>
                <td>{{ $data->last_month }}</td>
                <td>{{ $data->this_month }}</td>
                <td>{{ $data->difference }}</td>
                <td>{{ $data->bamboo }}</td>
                <td>{{ $data->trop_khnom }}</td>
                <td>{{ $data->lpi_168 }}</td>
                <td>{{ $data->cash }}</td>
                <td>{{ $data->other_mfi }}</td>
                <td>{{ $data->qty_sale_daily }}</td>
                <td>{{ $data->average_sale_daily }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Total</td>
                <td>{{ $totals['last_month'] }}</td>
                <td>{{ $totals['this_month'] }}</td>
                <td>{{ $totals['difference'] }}</td>
                <td>{{ $totals['bamboo'] }}</td>
                <td>{{ $totals['trop_khnom'] }}</td>
                <td>{{ $totals['lpi_168'] }}</td>
                <td>{{ $totals['cash'] }}</td>
                <td>{{ $totals['other_mfi'] }}</td>
                <td>{{ $totals['qty_sale_daily'] }}</td>
                <td>{{ $totals['average_sale_daily'] }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>