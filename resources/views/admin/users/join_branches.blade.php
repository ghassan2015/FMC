@extends('admin.layouts.master')

@section('title', __('label.users'))
@section('toolbarSubTitle', __('label.join_branch_list'))
@section('toolbarPage', __('label.display_all_join_branch_list'))

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
        <div class="row mb-5">

            @if (!auth('admin')->user()->branch_id)
                <div class="col-md-6 col-sm-6">
                    <select id="search_branch_id" name="branch_id" class="form-select form-select-solid"
                        data-control="select2">
                        <option value="">{{ __('label.all_branches') }}</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif





        </div>


    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th></th>
                <th>{{ __('label.name') }} </th>
                <th>{{ __('label.mobile') }}</th>
                <th>{{ __('label.total_contracts') }}</th>
                <th>{{ __('label.total_income') }}</th>
                <th>{{ __('label.cuurent_branch') }}</th>
                <th>{{ __('label.transfer_branch') }}</th>

                <th>{{ __('label.whatsapp') }}</th>
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




    @include('admin.users.modal.add')


@endsection

@push('scripts')
    @include('admin.users.js.join_branches')
@endpush

<!--end::Datatable-->
