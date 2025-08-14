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

                <th style=" width:22%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                    {{ __('label.total_users') }}</th>
                <th style="width:22%%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.total_amount') }}</th>

                <th style="width:22%%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.total_invoice_paid') }}</th>

                <th style="width:22%%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                    {{ __('label.total_invoice_not_paid') }}</th>
            </tr>



        </thead>
        <tbody>

            @foreach ($branches as $key => $value)
                <tr>
                    <td style="width:30px; padding:1px; text-align:center;">{{ $key + 1 }}</td>
                    <td style="padding:1px; text-align:center;">{{ $value->name }}</td>
                    <td style="padding:1px; text-align:center;">{{ $value->users()->count() }}</td>

                    <td style="width:12%; padding:1px; text-align:center;">{{ $value->totalInvoiceAmount() }}</td>

                    <td style="width:12%; padding:1px; text-align:center;">
                        {{ $value->totalInvoicePaid() }}

                    </td>
                    <td style="width:12%; padding:1px; text-align:center;">
                        {{ $value->totalInvoiceNotPaid() }}

                    </td>
                </tr>
            @endforeach




        </tbody>


    </table>


    </div>
</body>

</html>
