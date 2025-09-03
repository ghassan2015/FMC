<!--begin::Search-->
<div class="d-flex flex-column flex-md-row flex-stack mb-5 gap-3">
    <div class="d-flex align-items-center position-relative my-1 flex-grow-1 search_invoice search_block">
        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                class="path2"></span></i>
        <input type="text" data-kt-docs-table-filter="search_medical_test"
            class="form-control form-control-solid w-100 ps-15" placeholder="{{ __('label.search_placeholder') }}" />
    </div>




    <a class="btn btn-primary add_drug_user" data-bs-toggle="tooltip" title="{{ __('label.add_new_medical_test') }}">
        <i class="ki-duotone ki-plus fs-2"></i>
        {{ __('label.add_new_drug_user') }}
    </a>
</div>

<!-- Counters -->


<!-- Filters -->


<!-- Hidden user id -->

<!-- Table -->
<table id="drug_user_table" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
    <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.number_time_use') }}</th>
            <th>{{ __('label.created_at') }}</th>
            <th>{{ __('label.actions') }}</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@include('components.drugUsers.add_edit')

@include('components.drugUsers.script.index')
