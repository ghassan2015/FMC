<a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
    data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    <i class="fa fa-ellipsis-v fs-5"></i>
</a>

<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
    menu-state-bg-light-primary fw-bold fs-7 w-175px py-4 px-2 start-3"
    data-kt-menu="true">

    @can('view_user')


        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-check text-primary"></i>
            <a href="{{ route('admin.users.view', $data->id) }}" class="menu-link px-2">
                {{ __('label.view_user') }}
            </a>
        </div>
          @endcan
    @can('edit_user')

        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-edit text-warning"></i>
            <a href="{{ route('admin.users.edit', $data->id) }}" class="menu-link px-2">
                {{ __('label.edit_user') }}
            </a>
        </div>
        @endcan
















    @if (auth('admin')->user()->can('send_invoice_notification'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-bell text-warning"></i>
            <a href="#" class="menu-link px-2 sned_notification" data-user_id="{{ $data->id }}">
                {{ __('label.notifications') }}
            </a>
        </div>
    @endif




    {{-- حذف المستخدم --}}
    @if (auth('admin')->user()->can('delete_user'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-times text-danger"></i>
            <a href="#" class="menu-link px-2 delete_user" data-id="{{ $data->id }}"
                data-name_delete="{{ $data->name }}">
                {{ __('label.delete') }}
            </a>
        </div>
    @endif

</div>
