<table border="1">
    <thead>
        <tr>

            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.branch') }}</th>

            <th>{{ __('label.total_invoice_not_paid') }}</th>
            <th>{{ __('label.last_payment') }}</th>

        </tr>
    </thead>
    <tbody>

        @foreach ($users as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->branch?->name }}</td>
                <td>{!! $value->totalInvoiceNotPaid() !!}</td>
                <td>{{ $value->lastTransaction() }}</td>

            </tr>
        @endforeach

    </tbody>
</table>
