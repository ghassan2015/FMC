@extends('admin.layouts.master')
@section('title', __('label.medical_test_types'))
@section('toolbarSubTitle', __('label.medical_test_types'))
@section('toolbarPage', __('label.dispaly_all_medical_test_types'))


@section('content')

    <div class="d-flex flex-column flex-md-row flex-stack mb-5 gap-3">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1 flex-grow-1">
            <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                    class="path2"></span></i>
            <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-100 ps-15"
                placeholder="{{ __('label.search_placeholder') }}" />
        </div>
        <!--end::Search-->

        <!--begin::Toolbar-->
        <div class="d-flex flex-column flex-sm-row justify-content-end gap-2" data-kt-docs-table-toolbar="base">
            <button type="button" class="btn btn-light-primary me-0 me-sm-3" onclick="toggleFilter()">
                <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                {{ __('label.filter') }}
            </button>
            @can('add_medical_test')
                <button type="button" class="btn btn-primary add_city" data-bs-toggle="tooltip"
                    title="{{ __('label.add_new_medical_test') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    {{ __('label.add_new_medical_test') }}
                </button>
                @endcan
        </div>
        <!-- Group actions -->
        <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
            <div class="fw-bold me-5">
                <span class="me-2" data-kt-docs-table-select="selected_count"></span> {{ __('label.selected') }}
            </div>
            <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" title="{{ __('label.coming_soon') }}">
                {{ __('label.selection_action') }}
            </button>
        </div>
    </div>

    <div id="filter-section" class="row mb-5 d-none align-items-end">

        <div class="col-12 col-md-6 d-flex gap-2">
        </div>
    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">

                <th>{{ __('label.name') }}</th>


                <th></th>
            </tr>

        </thead>
        <tbody>

        </tbody>

    </table>











    <input type="hidden" name="show_modal" id="show_modal" value="{{ $modal }}">
    @include('Shared.delete')

    @include('admin.medicalTests.Model.view')

    @include('admin.medicalTests.Model.create_update')
@endsection

@push('scripts')
    @include('admin.medicalTests.js.js')
@endpush
