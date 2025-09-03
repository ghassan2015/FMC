
@if ( auth('admin')->user()->can('edit_medical_test')||auth('admin')->user()->can('delete_medical_test'))

<div class="dropdown text-center">
    <a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm"
       data-kt-menu-trigger="click"
       data-kt-menu-placement="bottom-end"
       data-kt-menu-flip="top-end">
        <i class="fa fa-ellipsis-v fs-5"></i>
    </a>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
                menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
         data-kt-menu="true">
@if ( auth('admin')->user()->can('edit_drug_user'))


        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3 edit_drug_user d-flex align-items-center gap-2"
               data-drug_id="{{ $data->id }}"
               data-name="{{ $data->name }}"
               data-number_time_use="{{ $data->number_time_use }}"
               data-photo="{{$data->photo}}">
                <i class="fas fa-edit text-primary"></i>
                {{ __('label.edit') }}
            </a>
        </div>

        @endif
        @if (auth('admin')->user()->can('delete_drug_user'))


        <div class="menu-item px-3">
            <a href="#" data-id="{{ $data->id }}"
              data-name_delete="{{ $data->title ?? 'Unknown' }}"
               class="menu-link px-3 delete_drug_user d-flex align-items-center gap-2">
                <i class="fa fa-trash text-danger"></i>
                {{ __('label.delete') }}
            </a>
        </div>


        @endif
    </div>
</div>
@endif
