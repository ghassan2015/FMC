<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.total_users') }}</th>
            <th>{{ __('label.total_amount') }}</th>
            <th>{{ __('label.total_invoice_paid') }}</th>
            <th>{{ __('label.total_invoice_not_paid') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($branches as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->users()->count() }}</td>
                <td>{{ $value->totalInvoiceAmount() }}</td>
                <td>{{ $value->totalInvoicePaid() }}</td>
                <td>{{ $value->totalInvoiceNotPaid() }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
