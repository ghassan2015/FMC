<table border="1">
    <thead>
        <tr>
            <th>#</th>
            <th>{{__('label.name')}}</th>
            <th>{{__('label.mobile')}}</th>
            <th>{{__('label.email')}}</th>
            <th>{{__('label.status')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($admins as $index => $admin)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->mobile }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->status == 1 ? 'نشط' : 'غير نشط' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
