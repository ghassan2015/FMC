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

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body dir="rtl">


    @include('Shared.top_header_pdf')

        <div style="padding: 5px;float: right; width: 100% ">
            <div bgcolor="#FFFF00" color="red" style="width: 40%;float: right;">
                <h4 style="font-family: 'XBRiyaz'; color: #d60000;">{{__('label.admin_report')}} </h4>
            </div>
            <div
                style="width: 40%; text-align: left;vertical-align:bottom;padding-top:15px;  direction: ltr; float: left;">
                <p style="font-family: 'XBRiyaz';"> </p>
            </div>
        </div>
        <table id="calender_tab" class=" table  table-bordered " style="text-align: center">
            <thead>
                <tr>
                    <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">#
                    </th>
                    <th style=" width:22%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.name') }}</th>
                    <th style="width:22%%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                        {{ __('label.mobile') }}</th>
                    <th style="width:22%%;padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz';">
                        {{ __('label.email') }}</th>
                    <th style="width:22%%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        <span>{{ __('label.status') }}</span>
                    </th>
                </tr>



            </thead>
            <tbody>

                @foreach ($admin as $key => $value)
                    <tr>
                        <td style="width:30px; padding:1px; text-align:center;">{{ $key + 1 }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->name }}</td>
                        <td style="width:12%; padding:1px; text-align:center;">{{ $value->mobile }}</td>
                        <td style="padding:1px; text-align:center;">{{ $value->email }}</td>

                        <td style="width:30px; padding:1px; text-align:center;">
                            @if ($value->status == 1)
                                <span style="color:green;">{{ __('label.active') }}</span>
                            @else
                                <span style="color:red;">{{ __('label.inactive') }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </div>
</body>

</html>
