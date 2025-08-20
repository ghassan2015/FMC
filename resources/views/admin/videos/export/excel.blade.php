<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.max_capacity') }}</th>
            <th>{{ __('label.total_users_registered_count') }}</th>
            <th>{{ __('label.user_count') }}</th>
            <th>{{ __('label.total_income') }}</th>
            <th>{{ __('label.total_contracts') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($branches as $index => $value)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->MaxCapacity() }}</td>
                <td>{{ $value->sumRegisteredCount() }}</td>
                <td>{{ $value->users()->count() }}</td>
                <td>{{ $value->totalIncomeMovements() }}</td>
                <td>{{ $value->totalJobContracts() }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
