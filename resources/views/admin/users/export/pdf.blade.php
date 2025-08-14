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
                    <th style="width:5%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">#
                    </th>
                    <th style=" width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.name') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                        {{ __('label.mobile') }}</th>
                    <th style="width:15%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                        {{ __('label.email') }}</th>
                    <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.branch') }}</span>
                    </th>


                        <th style="width:8%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.total_invoice_not_paid') }}</span>
                    </th>


                        <th style="width:8%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.total_contracts') }}</span>
                    </th>

                         <th style="width:8%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.total_income') }}</span>
                    </th>
                          <th style="width:8%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.placement_date') }}</span>
                    </th>


                          <th style="width:8%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.code_internet') }}</span>
                    </th>
                </tr>



            </thead>
            <tbody>

                @foreach ($users as $key => $value)
                    <tr>
                        <td style="width:30px; padding:1px; text-align:center;">{{ $key + 1 }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->name }}</td>
                        <td style="width:12%; padding:1px; text-align:center;">{{ $value->mobile }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->email }}</td>

                        <td style="padding:1px; text-align:center;">{{ $value->branch?->name }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->totalInvoiceNotPaid() }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->totalContracts() }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->totalIncome() }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->placement_date }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->code_internet }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>




</body>

</html>
