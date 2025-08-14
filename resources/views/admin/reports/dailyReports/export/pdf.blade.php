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
                <th style=" width:22%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                    {{ __('label.name') }}</th>
                <th style="width:22%%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.amount') }}</th>
                <th style="width:22%%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.date') }}</th>
                <th style="width:22%%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.invoice_number') }}</th>
            </tr>



        </thead>
        <tbody>

            @foreach ($invoices as $key => $value)
                <tr>
                    <td style="width:30px; padding:1px; text-align:center;">{{ $key + 1 }}</td>
                    <td style="padding:1px; text-align:center;">{{ $value?->users?->name }}</td>
                    <td style="width:12%; padding:1px; text-align:center;">{{ $value->full_amount }}</td>
                    <td style="width:12%; padding:1px; text-align:center;">
                        {{ $value->transactions?->created_at->format('Y-m-d') }}
                    </td>
                    <td style="width:12%; padding:1px; text-align:center;">
                        {{ '#' . $value->id }}
                    </td>

                </tr>
            @endforeach


   <tr>
                    <td style="width:30px; padding:1px; text-align:center;">{{__('label.total_amount')}}</td>
                    <td style="padding:1px; text-align:center;"></td>
                    <td style="width:12%; padding:1px; text-align:center;color:red">{{$totalDollarAmount.'$'  .' - '. $totalShekelAmount .' ₪'}}</td>
                    <td style="width:12%; padding:1px; text-align:center;">
                    </td>
                    <td style="width:12%; padding:1px; text-align:center;">
                    </td>

                </tr>

        </tbody>


    </table>


    </div>
</body>

</html>
