@if (auth('admin')->user()->can('delete_articale') || auth('admin')->user()->can('delete_articale'))

    <a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
        <i class="fa fa-ellipsis-v fs-5"></i>
    </a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
        data-kt-menu="true">
        @if (auth('admin')->user()->can('edit_appointment'))
            <div class="menu-item px-3">
                <a class="menu-link px-3 edit"
                        data-appointment_id="{{ $data->id }}"
                        data-time="{{$data->time}}"
                        data-date="{{$data->date}}"
                        data-branch_id="{{$data->branch_id }}"
                        data-doctor_id ="{{$data->doctor_id  }}"
                        data-user_id ="{{$data->user_id  }}"
                        data-is_paid="{{$data->is_paid }}"
                        data-payment_type_id="{{$data->payment_type_id }}"
                        data-appointment_status_cd_id="{{$data->appointment_status_cd_id }}"


                    data-kt-docs-table-filter="edit_row">
                    <i class="fa fa-edit px-3" style="color: #007bff;"></i>
                    {{ __('label.edit') }}
                </a>
            </div>
        @endif
        @if (auth('admin')->user()->can('delete_appointment'))
            <div class="menu-item px-3">
                <a data-id="{{ $data->id }}" class="menu-link px-3 delete_appointment " data-kt-docs-table-filter="delete_row"
                    data-name_delete="{{ $data->users?->name }}" class="delete" title="{{ __('label.delete') }}">
                    <i class="fa fa-trash px-3" style="color: #dc3545;"></i>
                    {{ __('label.delete') }}
                </a>
            </div>
        @endif
    </div>

@endif
