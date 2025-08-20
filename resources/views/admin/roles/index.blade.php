@extends('admin.layouts.master')

@section('title', __('label.roles'))
@section('toolbarSubTitle', __('label.role_list'))
@section('toolbarPage', __('label.display_all_roles'))

@section('content')
    <div class="d-flex flex-stack mb-5">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                    class="path2"></span></i>
            <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-400px ps-15"
                placeholder="{{ __('label.search_placeholder') }}" />
        </div>
        <!--end::Search-->

        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">

            <!-- Toolbar -->
            <button type="button" class="btn btn-light-primary me-3" onclick="toggleFilter()">
                <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                {{ __('label.filter') }}
            </button>
            @can('add_roles')
                <a href="{{ route('admin.roles.create') }}" type="button" class="btn btn-primary" data-bs-toggle="tooltip"
                    title="{{ __('label.add_new_role') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    {{ __('label.add_new_role') }}
                </a>
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


    <!-- Filter Section -->
    <div id="filter-section" class="row mb-5 d-none align-items-end">
        <!-- Search Input -->
        <div class="row mb-5">

            <div class="col-md-6">
                <select class="form-select form-select-solid" data-control="select2" id="isActiveFilter">
                    <option value="">{{ __('label.status') }}</option>
                    <option value="0">{{ __('label.inactive') }}</option>
                    <option value="1">{{ __('label.active') }}</option>

                </select>
            </div>
        </div>

    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th>{{ __('label.name') }}</th>
                @can('update_status_roles')
                    <th>{{ __('label.status') }}</th>
                @endcan
                <th>{{ __('label.actions') }}</th>

            </tr>
        </thead>
        <tbody class="text-gray-600 fw-semibold">
            <div id="datatable-loader" style="display:none; text-align:center; margin: 20px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">جاري التحميل...</span>
                </div>
            </div>
        </tbody>
    </table>
@endsection

@push('scripts')
    @include('admin.roles.js.index')
@endpush

<!--end::Datatable-->
