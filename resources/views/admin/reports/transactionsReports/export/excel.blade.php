<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ __('label.date') }}</th>
            <th>{{ __('label.form_account') }}</th>
            <th>{{ __('label.to_account') }}</th>
            <th>{{ __('label.balance') }}</th>

            <th>{{ __('label.details') }}</th>

        </tr>
    </thead>
    <tbody>
        @php
            $runningBalance = 0.0; // هذا هو الرصيد الابتدائي قبل أول عملية
        @endphp

        @foreach ($transactionReports as $index => $value)
            @php
                // نحدث الرصيد حسب العملية
                $debit = $value->balance_type_id == 6 ? $value->amount : 0; // مدين
                $credit = $value->balance_type_id == 7 ? $value->amount : 0; // دائن

                $runningBalance += $debit - $credit;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $value->date }}</td>
                <td>{{ $value->formAccount?->name }}</td>
                <td>{{ $value->toAccount?->name }}</td>

                <td>{{ number_format($runningBalance, 2) }}</td>
                <td>{{ $value->invoices?'فاتورة '.$value->invoices->created_at->format('Y-m') :'' }}</td>

            </tr>
        @endforeach

    </tbody>
</table>
