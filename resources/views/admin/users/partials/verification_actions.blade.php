
<a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm"
   data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
    <i class="fa fa-ellipsis-v fs-5"></i>
</a>

<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
    menu-state-bg-light-primary fw-bold fs-7 w-175px py-4 px-2 start-3" data-kt-menu="true">

        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
            <i class="fas fa-check	 text-success"></i>
            <a href="#" class="menu-link px-2 edit_verification_user" data-user_id="{{$data->id}}"
              >
                {{ __('label.confirm') }}
            </a>
        </div>

</div>
