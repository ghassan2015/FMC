<a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
    data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    <i class="fa fa-ellipsis-v fs-5"></i>
</a>

<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
    menu-state-bg-light-primary fw-bold fs-7 w-175px py-4 px-2 start-3"
    data-kt-menu="true">

    {{-- المستخدم --}}
    @if (auth('admin')->user()->can('view_users'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-check text-primary"></i>
            <a href="{{ route('admin.users.views', $data->id) }}" class="menu-link px-2">
                {{ __('label.view_user') }}
            </a>
        </div>
    @endif

    {{-- تعديل المستخدم --}}
    @if (auth('admin')->user()->can('edit_users'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-edit text-warning"></i>
            <a href="{{ route('admin.users.edit', $data->id) }}" class="menu-link px-2">
                {{ __('label.edit_user') }}
            </a>
        </div>
    @endif
    @php
        $canView = auth('admin')->user()->can('view_invoice');
        $notDeleted = request('status') !== 'delete-hub';
        $noUserRooms = $data?->userRooms?->isEmpty() ?? true;
        $hasRooms = $data?->rooms()->count() > 0;
    @endphp

    {{-- عرض الفواتير --}}

    @if (auth('admin')->user()->can('view_service') && $data->status == 1)
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-cogs text-primary"></i>
            <a href="#" class="menu-link px-2 service_list" data-bs-toggle="modal"
                data-bs-target="#serviceListModal" data-user-id="{{ $data->id }}"> <!-- Add this attribute -->

                {{ __('label.services') }}
            </a>
        </div>
    @endif


    @if (auth('admin')->user()->can('add_service') && $data->status == 1)
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-network-wired text-primary"></i>
            <a href="#" class="menu-link px-2 add_service" data-user_id="{{ $data->id }}"
                data-desk_mangment_id="{{ $data->id }}">
                {{ __('label.add_service') }}
            </a>
        </div>
    @endif

    @if (($canView && $notDeleted && $noUserRooms) || $hasRooms)
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-file-invoice-dollar text-info"></i>
            <a href="#" class="menu-link px-2 view-invoice" data-user_id="{{ $data->id }}">
                {{ __('label.view_invoice') }}
            </a>
        </div>
    @endif




    {{-- إضافة فاتورة --}}
    @if (($canView && $notDeleted && $noUserRooms) || $hasRooms)
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-file-invoice text-success"></i>
            <a href="#" class="menu-link px-2 add_invoice" data-user_id="{{ $data->id }}">
                {{ __('label.add_invoice') }}
            </a>
        </div>
    @endif





    @if (auth('admin')->user()->can('view_internet_subscription') &&
            $data->status == 1 &&
            request('status') !== 'delete-hub')
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-wifi text-primary"></i>
            <a href="#" class="menu-link px-2 internet_subscription" data-user_id="{{ $data->id }}"
                data-desk_mangment_id="{{ $data->id }}">
                {{ __('label.internet_subscription') }}
            </a>
        </div>
    @endif

    @if (auth('admin')->user()->can('send_invoice_notification'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-bell text-warning"></i>
            <a href="#" class="menu-link px-2 sned_notification" data-user_id="{{ $data->id }}">
                {{ __('label.notifications') }}
            </a>
        </div>
    @endif
    {{-- تحقق المستخدم --}}
    @if (auth('admin')->user()->can('verification_users'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-check text-success"></i>
            <a href="#" class="menu-link px-2 verification_user" data-user_id="{{ $data->id }}">
                {{ __('label.user_verification') }}
            </a>
        </div>
    @endif

    {{-- تغيير حالة المستخدم أو نقله لفرع --}}
    @if (auth('admin')->user()->can('add_To_branch') && request('status') !== 'delete-hub')
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-exchange-alt text-info"></i>
            <a href="#" class="menu-link px-2 add_user" data-user_id="{{ $data->id }}"
                data-branch_id="{{ $data->branch_id }}" data-status="{{ $data->status }}"
                data-work_space_id="{{ $data->work_space_id }}" data-desk_mangment_id="{{ $data->desk_mangment_id }}"
                data-user_type_cd_id="{{ $data->user_type_cd_id }}">
                {{ __('label.status_user') }}
            </a>
        </div>
    @endif

    {{-- تحرير المكتب --}}
    @if (auth('admin')->user()->can('release_desk_mangment') && $data->deskMangment)
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-door-open text-success"></i>
            <a href="#" class="menu-link px-2 release" data-id="{{ $data->deskMangment->id }}"
                data-code="{{ $data->deskMangment->code }}">
                {{ __('label.release_desk_mangment') }}
            </a>
        </div>
    @endif

    {{-- حذف المستخدم --}}
    @if (auth('admin')->user()->can('delete_users'))
        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-user-times text-danger"></i>
            <a href="#" class="menu-link px-2 delete_user" data-id="{{ $data->id }}"
                data-name_delete="{{ $data->name }}">
                {{ __('label.delete') }}
            </a>
        </div>
    @endif

</div>
