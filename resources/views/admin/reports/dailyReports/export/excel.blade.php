<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.amount') }}</th>
            <th>{{ __('label.date') }}</th>
            <th>{{ __('label.invoice_number') }}</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->users?->name }}</td>

                <td>{{ $value->amount }}</td>
                <td>{{ $value->transactions?->created_at->format('Y-m-d') }}</td>
                <td> {{ '#' . $value->id }}</td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td>{{ __('label.total_amount') }}</td>

            <td>{{ $totalDollarAmount . '$' . ' - ' . $totalShekelAmount . ' ₪' }}</td>
            <td></td>
            <td></td>
        </tr>

    </tbody>
</table>
