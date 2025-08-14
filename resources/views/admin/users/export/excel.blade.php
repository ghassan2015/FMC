<table border="1" class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.mobile') }}</th>
            <th>{{ __('label.email') }}</th>
            <th>{{ __('label.branch') }}</th>
            <th>{{ __('label.total_invoice_not_paid') }}</th>
            <th>{{ __('label.total_contracts') }}</th>
            <th>{{ __('label.total_income') }}</th>
            <th>{{ __('label.placement_date') }}</th>
            <th>{{ __('label.code_internet') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $value)
            <tr>

                <td>{{ $index + 1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->mobile }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->branch?->name ?? '-' }}</td>
                <td>{{ $value->totalInvoiceNotPaid() ?? 0 }}</td>
                <td>{{ $value->totalContracts() ?? 0 }}</td>
                <td>{{ number_format($value->totalIncome() ?? 0, 2) }}</td>
                <td>{{ $value->placement_date}}</td>
                <td>{{ $value->code_internet ?? '-' }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
