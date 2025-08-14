<html>

<head>
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    <style>
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th {
            padding: 6px !important;
            line-height: 1 !important;
            vertical-align: top !important;
            font-size: 12px !important;
        }

        hr {
            margin: 2px !important;
        }

        * {
            direction: rtl !important;
        }
    </style>
</head>

<body dir="rtl">




    <table id="calender_tab" class=" table  table-bordered " style="text-align: center">
        <thead>
            <tr>
                <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">#
                </th>
                <th style=" width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                    {{ __('label.date') }}</th>
                <th style="width:30%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.form_account') }}</th>
                <th style="width:30%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.to_account') }}</th>
                <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                    <span>{{ __('label.amount') }}</span>
                <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                    <span>{{ __('label.details') }}</span>
                </th>
            </tr>



        </thead>
        <tbody>
            @php
                $runningBalance = 0.0; // هذا هو الرصيد الابتدائي قبل أول عملية
            @endphp

            @foreach ($transactions as $key => $value)
                @php
                    // نحدث الرصيد حسب العملية
                    $debit = $value->balance_type_id == 6 ? $value->amount : 0; // مدين
                    $credit = $value->balance_type_id == 7 ? $value->amount : 0; // دائن

                    $runningBalance += $debit - $credit;
                @endphp
                <tr>
                    <td style="width:30px; padding:1px; text-align:center;">{{ $key + 1 }}</td>
                    <td style="padding:1px; text-align:center;">{{ $value->date }}</td>
                    <td style="width:12%; padding:1px; text-align:center;">{{ $value->formAccount?->name }}</td>
                    <td style="width:12%; padding:1px; text-align:center;">
                        {{ $value->toAccount?->name }}</td>
                    <td style="width:12%; padding:1px; text-align:center;">{{ $runningBalance }}</td>

                    <td style="padding:1px; text-align:center;">
                        {{ $value->invoices ? 'فاتورة ' . $value->invoices->created_at->format('Y-m') : '' }}</td>


                </tr>
            @endforeach

        </tbody>
    </table>


    </div>
</body>

</html>
