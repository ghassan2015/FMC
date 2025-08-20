@extends('admin.layouts.master')

@section('title', __('label.admins'))
@section('toolbarSubTitle', __('label.admins_list'))
@section('toolbarPage', __('label.display_all_admins'))

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
            @can('add_admin')
                <a class="btn btn-primary add_branch" data-bs-toggle="tooltip" href="{{ route('admin.admins.create') }}"
                    title="{{ __('label.add_new_admin') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    {{ __('label.add_new_admin') }}
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

    <div id="filter-section" class="row mb-5 d-none align-items-end">

        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <select class="form-select form-select-solid" dir="rtl" data-control="select2" id="branchFilter">
                <option value="">{{ __('label.branch') }}</option>
                @foreach ($branches as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <select class="form-select form-select-solid" dir="rtl" data-control="select2" id="roleFilter">
                <option value="">{{ __('label.role') }}</option>
                @foreach ($roles as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <select class="form-select form-select-solid" dir="rtl" data-control="select2" id="isActiveFilter">
                <option value="">{{ __('label.status') }}</option>
                <option value="0">{{ __('label.inactive') }}</option>
                <option value="1">{{ __('label.active') }}</option>
            </select>
        </div>



    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th>{{ __('label.name') }}</th>
                <th>{{ __('label.mobile') }}</th>
                <th>{{ __('label.email') }}</th>
                <th>{{ __('label.roles') }}</th>
                <th>{{ __('label.branches') }}</th>
                @can('update_status_admin')
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
    @include('admin.admins.js.index')
@endpush

