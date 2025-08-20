@if (auth('admin')->user()->can('delete_articale') || auth('admin')->user()->can('delete_articale'))

    <a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
        data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
        <i class="fa fa-ellipsis-v fs-5"></i>
    </a>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
        data-kt-menu="true">
        @if (auth('admin')->user()->can('edit_articale'))
            <div class="menu-item px-3">
                <a class="menu-link px-3 edit"
                data-articale_id="{{ $data->id }}"
                    data-title_ar="{{ $data->getTranslation('title', 'ar') }}"
                    data-title_en="{{ $data->getTranslation('title', 'en') }}"
                        data-description_ar="{{ $data->getTranslation('description', 'ar') }}"
                    data-description_en="{{ $data->getTranslation('description', 'en') }}"
                    data-photo="{{ $data->photo }}"
                    data-is_active="{{ $data->is_active }}"
                    data-kt-docs-table-filter="edit_row">
                    <i class="fa fa-edit px-3" style="color: #007bff;"></i>
                    {{ __('label.edit') }}
                </a>
            </div>
        @endif
        @if (auth('admin')->user()->can('delete_articale'))
            <div class="menu-item px-3">
                <a data-id="{{ $data->id }}" class="menu-link px-3 delete " data-kt-docs-table-filter="delete_row"
                    data-name_delete="{{ $data->title }}" class="delete"
                    title="{{ __('label.delete') }}">
                    <i class="fa fa-trash px-3" style="color: #dc3545;"></i>
                    {{ __('label.delete') }}
                </a>
            </div>
        @endif
    </div>

@endif
