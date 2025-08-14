<a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm"
   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    <i class="fa fa-ellipsis-v fs-5"></i>
</a>

<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
    menu-state-bg-light-primary fw-bold fs-7 w-175px py-4 px-2 start-3" data-kt-menu="true">

    {{-- المستخدم --}}
    @if (auth('admin')->user()->can('view_users') && request('status') !== 'delete-hub')
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-check text-primary"></i>
            <a href="{{ route('admin.users.views', $data->user_id) }}" class="menu-link px-2">
                {{ __('label.view_user') }}
            </a>
        </div>
    @endif

    {{-- تعديل المستخدم --}}
    @if (auth('admin')->user()->can('edit_users') && request('status') !== 'delete-hub')
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-edit text-warning"></i>
            <a href="{{ route('admin.users.edit', $data->user_id) }}" class="menu-link px-2">
                {{ __('label.edit_user') }}
            </a>
        </div>
    @endif




    {{-- تغيير حالة المستخدم أو نقله لفرع --}}
    @if (auth('admin')->user()->can('add_To_branch') && request('status') !== 'delete-hub')
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-exchange-alt text-info"></i>
            <a href="#" class="menu-link px-2 add_user"
               data-user_id="{{ $data->user_id }}"
               data-branch_id="{{ $data->users?->branch_id }}"
               data-status="{{ $data->users?->status }}"
               data-work_space_id="{{ $data->users?->work_space_id }}"
               data-desk_mangment_id="{{ $data->users?->desk_mangment_id }}"
               data-user_type_cd_id="{{ $data->users?->user_type_cd_id }}">
                {{ __('label.status_user') }}
            </a>
        </div>
    @endif



    {{-- حذف المستخدم --}}
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-times text-danger"></i>
            <a href="#" class="menu-link px-2 delete_join_branch"
               data-id="{{ $data->id }}" data-name_delete="{{ $data->users?->name }}">
                {{ __('label.delete') }}
            </a>
        </div>

</div>
