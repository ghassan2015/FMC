<!--begin::Search-->
<div class="d-flex flex-column flex-md-row flex-stack mb-5 gap-3">
    <div class="d-flex align-items-center position-relative my-1 flex-grow-1 search_invoice search_block">
        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                class="path2"></span></i>
        <input type="text" data-kt-docs-table-filter="search_surgical_operation"
            class="form-control form-control-solid w-100 ps-15" placeholder="{{ __('label.search_placeholder') }}" />
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2" data-kt-docs-table-toolbar="base">
        <button type="button" class="btn btn-light-primary me-0 me-sm-3" onclick="toggleSurgicalOperationFilter()">
            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
            {{ __('label.filter') }}
        </button>


        @can('add_surgical_operation')
        <a class="btn btn-primary add_surgical_operation" data-bs-toggle="tooltip"
            title="{{ __('label.add_new_surgical_operation') }}">
            <i class="ki-duotone ki-plus fs-2"></i>
            {{ __('label.add_new_surgical_operation') }}
        </a>
        @endcan
    </div>
</div>

<!-- Counters -->
<div class="row mb-4">
    <div class="col-lg-4 col-sm-6">
        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-wallet fs-1 text-warning me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.surgical_operation_count') }}</label>
                    <div id="surgical_operation_count" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-credit-cart fs-1 text-success me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.surgical_operation_competed') }}</label>
                    <div id="surgical_operation_competed" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6">
        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-check-circle fs-1 text-warning me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.surgical_operation_pendding') }}</label>
                    <div id="surgical_operation_pendding" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div id="filter-surgical-operation-section" class="row mb-5 d-none align-items-end">
    <div class="row mb-4">
        <div class="col-lg-4 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.start_date') }}</label>
            <input type="text" class="form-control kt_datepicker" readonly
                id="search_surgical_operation_start_date" />
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.end_date') }}</label>
            <input type="text" class="form-control kt_datepicker" readonly id="search_surgical_operation_end_date" />
        </div>
        <div class="col-lg-4 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.status') }}</label>
            <select class="form-select form-select-solid" data-control="select2" id="search_surgical_operation_status">
                <option value="">{{ __('label.all_statues') }}</option>
                @foreach ($constants as $value)
                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<!-- Hidden user id -->
<input type="hidden" id="surgical_operation_list_user_id" value="{{ isset($user) ? optional($user)->id : '' }}">

<!-- Table -->
<table id="surgical_operation_table" class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th>{{ __('label.title') }}</th>
            <th>{{ __('label.user_name') }}</th>
            <th>{{ __('label.doctors') }}</th>
            <th>{{ __('label.date') }}</th>
            <th>{{ __('label.time') }}</th>
            <th>{{ __('label.status') }}</th>
            <th>{{ __('label.created_at') }}</th>
            <th>{{ __('label.actions') }}</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@include('components.surgicalOperations.add_edit')

@include('components.surgicalOperations.script.index')
