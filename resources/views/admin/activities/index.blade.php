@extends('admin.layouts.master')

@section('title', __('label.activities'))
@section('toolbarSubTitle', __('label.activities_list'))
@section('toolbarPage', __('label.display_all_activities'))

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
            <div class="col-md-4 ">

                <label for="search_admin_id" class="form-label ">{{ __('label.admin_list') }}</label>
                <select data-control="select2" class="form-select form-select-solid" id="search_admin_id"
                    name="search_admin_id" style="width: 100%">
                    <option value="">{{ __('label.display_all_admins') }}</option>

                    @foreach ($admins as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach


                </select>
            </div>



            <!-- start_date -->
            <div class="col-md-4 ">
                <label class="form-label ">{{ __('label.start_date') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control kt_datepicker" readonly name="serach_start_date"
                        id="serach_start_date" />
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>

            <!-- end_date -->
            <div class="col-md-4">
                <label for="add_edit_end_date" class="form-label required">{{ __('label.end_date') }}</label>
                <div class="input-group">
                    <input type="text" class="form-control kt_datepicker" readonly name="search_end_date"
                        id="search_end_date" />
                    <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th>{{ __('label.activite_name') }}</th>
                <th>{{ __('label.description') }}</th>
                <th>{{ __('label.transaction_port') }}</th>
                <th>{{ __('label.date') }}</th>

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
    @include('admin.activities.js.index')
@endpush

<!--end::Datatable-->
