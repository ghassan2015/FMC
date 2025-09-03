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

    <div class="wrapper">
        <div style="
    float: left; width: 100%;">
            <table class="table" style=" border-width:0; text-align: center ;">
                <tr style="border-width:0 ;font-size: 18px;">
                    <td style="border-width:0;width: 40% ">
                        <div
                            style="border-width:0; text-align:center; font-family:'XBRiyaz',serif;font-size: 20px; font-weight: bold;">
                            <span>دولة فلسطين</span>
                            <br>
                            <span>حاضنة طاقات غزة</span>
                        </div>
                    </td>
                    <td style="border-width:0;text-align: center;width: 20%;  ">
                        <img height="60px" src="{{ asset('assets/logo.svg') }}" alt="User profile picture">
                    </td>
                    <td style="border-width:0;width: 40% ">
                        <div
                            style="border-width:0; text-align:center; font-family:'XBRiyaz',serif;font-size: 20px; font-weight: bold;">
                            <span>State of Palestine</span>
                            <br>
                            <span>Taqat Gaza Incubator</span>
                        </div>
                    </td>
                </tr>
            </table>
            <hr style="border-color: #000 !important;">

        </div>

        <div style="padding: 5px;float: right; width: 100% ">
            <div bgcolor="#FFFF00" color="red" style="width: 40%;float: right;">
                <h4 style="font-family: 'XBRiyaz'; color: #d60000;">{{ __('label.branch_report') }}</h4>
            </div>
            <div
                style="width: 40%; text-align: left;vertical-align:bottom;padding-top:15px;  direction: ltr; float: left;">
                <p style="font-family: 'XBRiyaz';"> </p>
            </div>
        </div>
        <table border="1" class="table table-bordered" style="text-align: center">
            <thead>
                <tr>
                    <th style="width:10%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">#
                    </th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.name') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.max_capacity') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.total_users_registered_count') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.user_count') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.total_income') }}</th>
                    <th style="width:15%; padding:1px; padding-right:2px; text-align:center; font-family:'XBRiyaz'">
                        {{ __('label.total_contracts') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $index => $value)
                    <tr>
                        <td class="width:10%; padding:1px; text-align:center;">{{ $index + 1 }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->name }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->MaxCapacity() }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->sumRegisteredCount() }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->users()->count() }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->totalIncomeMovements() }}</td>
                        <td lass="width:15; padding:1px; text-align:center;">{{ $value->totalJobContracts() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    </div>
</body>

</html>
