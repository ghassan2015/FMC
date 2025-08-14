<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.service_name') }}</th>

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
                <td>{{ $value->services?->name }}</td>
                <td>{{ $value->full_name }}</td>
                <td>{{ $value->created_at->format('Y-m-d') }}</td>
                <td> {{ '#' . $value->id }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" style="text-align: right; font-weight: bold; font-size: 16px;">
                {{ __('label.total_amount') }}
            </td>
            <td colspan="4">
                <div>{{ $totalDollarAmount }} $</div>
                <div style="margin-top: 4px;">{{ $totalShekelAmount }} ₪</div>
            </td>
        </tr>


    </tbody>
</table>
