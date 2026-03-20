<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $sale->invoice_no }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Khmer OS', 'Courier New', Courier, monospace;
            font-size: 13px;
            margin: 0;
            padding: 8px 12px;
            width: 300px;           /* Good default for 80mm thermal */
            color: #000;
            line-height: 1.3;
        }
        .center { text-align: center; }
        .right  { text-align: right; }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        td { padding: 1px 0; vertical-align: top; }
        .border-top { border-top: 1px dashed #000; margin: 6px 0; }
        .fw-bold { font-weight: bold; }
        h5 { margin: 4px 0; font-size: 16px; }
        .small { font-size: 11px; }
        @media print {
            body { width: 72mm; margin: 0; padding: 0; font-size: 12px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print(); setTimeout(() => window.close(), 800);">

    <div class="center">
        <h5 class="fw-bold">{{ config('app.name', 'ហាង រ៉េន') }}</h5>
        <div class="small">Branch: {{ $sale->branch?->name ?? '—' }}</div>
        @if($sale->customer)
            <div class="small">អតិថិជន៖ {{ $sale->customer->name }}</div>
        @endif
        <div>វិក្កយបត្រ៖ <strong>{{ $sale->invoice_no }}</strong></div>
        <div class="small">{{ $sale->sale_date->format('d/m/Y H:i') }}</div>
        <div class="small">បុគ្គលិក៖ {{ $sale->user?->name ?? '—' }}</div>
    </div>

    <div class="border-top"></div>

    <table>
        <thead>
            <tr>
                <td class="fw-bold">ទំនិញ</td>
                <td class="right fw-bold">ចំនួន</td>
                <td class="right fw-bold">តម្លៃ</td>
                <td class="right fw-bold">សរុប</td>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->items as $item)
                <tr>
                    <td>{{ Str::limit($item->product?->name ?? '—', 22) }}</td>
                    <td class="right">{{ $item->qty }}</td>
                    <td class="right">{{ number_format($item->unit_price, 0) }}</td>
                    <td class="right">{{ number_format($item->total, 0) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="border-top"></div>

    <table>
        <tr>
            <td>សរុបរង</td>
            <td class="right">{{ number_format($sale->subtotal, 0) }} ៛</td>
        </tr>
        @if($sale->discount > 0)
        <tr>
            <td>បញ្ចុះតម្លៃ</td>
            <td class="right">-{{ number_format($sale->discount, 0) }} ៛</td>
        </tr>
        @endif
        <tr class="fw-bold">
            <td>សរុបរួម</td>
            <td class="right">{{ number_format($sale->total, 0) }} ៛</td>
        </tr>
        <tr>
            <td>បានបង់</td>
            <td class="right">{{ number_format($sale->paid_amount, 0) }} ៛</td>
        </tr>
        @if($sale->change_amount > 0)
        <tr>
            <td>អាប់ប្រាក់</td>
            <td class="right">{{ number_format($sale->change_amount, 0) }} ៛</td>
        </tr>
        @endif
        @if($sale->due_amount > 0)
        <tr class="text-danger fw-bold">
            <td>នៅជំពាក់</td>
            <td class="right">{{ number_format($sale->due_amount, 0) }} ៛</td>
        </tr>
        @endif
    </table>

    <div class="border-top"></div>

    <div class="center small">
        <div>វិធីបង់៖ {{ strtoupper($sale->payment_status) }} • {{ ucfirst($sale->payment_method ?? '—') }}</div>
        @if($sale->note)
            <div class="mt-1">ចំណាំ៖ {{ $sale->note }}</div>
        @endif
        <div class="mt-3 fw-bold">អរគុណ! សូមមកម្តងទៀត ❤️</div>
    </div>

</body>
</html>