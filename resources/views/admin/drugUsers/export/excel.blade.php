<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.mobile') }}</th>
            <th>{{ __('label.branch') }}</th>
            <th>{{ __('label.amount') }}</th>
            <th>{{ __('label.start_date') }}</th>
            <th>{{ __('label.end_date') }}</th>
            <th>{{ __('label.status') }}</th>
            <th>{{ __('label.created_at') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($invoices as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->users?->name }}</td>
                <td>{{ $value->users?->mobile }}</td>
                <td>{{ $value->users?->branch?->name }}</td>
                <td>{{ $value->amount }}</td>
                <td>{{ $value->expiration_date }}</td>
                <td>{{ $value->due_date }}</td>
                <td>{!! $value->getStatus() !!}</td>
                <td>{{ $value->created_at->format('Y-m-d') }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
