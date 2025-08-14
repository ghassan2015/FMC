<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.mobile') }}</th>
            <th>{{ __('label.date') }}</th>
            <th>{{ __('label.start_time') }}</th>
            <th>{{ __('label.end_time') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->users?->name }}</td>
                <td>{{ $value->mobile }}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->time_in }}</td>
                <td>{{ $value->time_out }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
