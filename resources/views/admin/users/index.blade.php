@extends('admin.layouts.master')

@section('title', __('label.users'))
@section('toolbarSubTitle', __('label.users_list'))
@section('toolbarPage', __('label.display_all_users'))

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
            <a type="button" href="{{ route('admin.users.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                title="{{ __('label.add_new_user') }}">
                <i class="ki-duotone ki-plus fs-2"></i>
                {{ __('label.add_new_user') }}
            </a>
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
                <div class="col-md-3 col-sm-6">
                    <label for="search_branch_id" class="form-label mb-1">{{ __('label.branch') }}</label>
                    <select id="search_branch_id" name="branch_id" class="form-select form-select-solid"
                        data-control="select2">
                        <option value="">{{ __('label.all_branches') }}</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}" @selected($branch->id == $branch_id)>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- مكان النزوح --}}
            <div class="col-md-3 col-sm-6">
                <label for="search_displacement_place" class="form-label mb-1">{{ __('label.displacement_place') }}</label>
                <select id="search_displacement_place" name="displacement_place" class="form-select form-select-solid"
                    data-control="select2">
                    <option value="">{{ __('label.all_displacement_places') }}</option>
                    <option value='["مدينة غزة", "gaza"]'>{{ __('label.gaza') }}</option>
                    <option value='["شمال غزة", "north"]'>{{ __('label.north_gaza') }}</option>
                    <option value='["خانيونس", "khn"]'>{{ __('label.khanyounis') }}</option>
                    <option value='["الوسطى", "central", "دير البلح", "النصيرات", "الزوايدة"]'>
                        {{ __('label.central_gaza') }}</option>
                    <option value='["rafah", "رفح"]'>{{ __('label.rafah') }}</option>
                </select>
            </div>

            {{-- الحالة --}}
            <div class="col-md-3 col-sm-6">
                <label for="search_status" class="form-label mb-1">{{ __('label.status') }}</label>
                <select id="search_statuses" class="form-select form-select-solid" data-control="select2">
                    <option value="">{{ __('label.all_statuses') }}</option>
                    <option value="inside-hub" @selected($status == 'inside-hub')>{{ __('label.users_inside_hub_menu') }}
                    </option>
                    <option value="non-hub" @selected($status == 'non-hub')>{{ __('label.users_no_hub_menu') }}</option>
                    <option value="non-active" @selected($status == 'non-active')>{{ __('label.users_not_avtive') }}</option>
                    <option value="under-verification" @selected($status == 'under-verification')>
                        {{ __('label.users_under_verification') }}</option>
                    {{-- <option value="delete-hub" @selected($status == 'delete-hub')>{{ __('label.delete_users') }}</option> --}}
                </select>
            </div>

            {{-- نوع الخدمة --}}
            <div class="col-md-3 col-sm-6">
                <label for="search_user_type_cd_id" class="form-label mb-1">{{ __('label.service_type') }}</label>
                <select id="search_user_type_cd_id" name="user_type_cd_id" class="form-select form-select-solid"
                    data-control="select2">
                    <option value="">{{ __('label.all_service_type') }}</option>
                    @foreach ($userTypes as $userType)
                        <option value="{{ $userType->id }}">{{ $userType->value }}</option>
                    @endforeach
                </select>
            </div>

            {{-- الحضور في مكان العمل --}}
            <div class="col-md-3 col-sm-6">
                <label for="search_workplace_attendance"
                    class="form-label mb-1">{{ __('label.workplace_attendance') }}</label>
                <select id="search_workplace_attendance" name="workplace_attendance" class="form-select form-select-solid"
                    data-control="select2">
                    <option value="">{{ __('label.all_workplace_attendance') }}</option>
                    <option value="full_time">{{ __('label.full_time') }}</option>
                    <option value="part_time">{{ __('label.part_time') }}</option>
                </select>
            </div>

            <div class="col-md-4 d-flex gap-3 mt-4 justify-content-center">
                <button type="button" id="exportExcelBtn"
                    class="btn btn-success d-flex align-items-center flex-grow-1 px-4 py-2 shadow-sm rounded-3">
                    <i class="fas fa-file-excel fs-4 me-2" style="color: #fff;"></i>
                    <span class="fw-semibold text-white">{{ __('label.export_excel') }}</span>
                </button>
                <button type="button" id="exportPdfBtn"
                    class="btn btn-danger d-flex align-items-center flex-grow-1 px-4 py-2 shadow-sm rounded-3">
                    <i class="fas fa-file-pdf fs-4 me-2" style="color: #fff;"></i>
                    <span class="fw-semibold text-white">{{ __('label.export_pdf') }}</span>
                </button>
            </div>


        </div>


    </div>
    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th style="width: 4%;"></th>
                <th style="width: 10%;">{{ __('label.name') }} </th>
                <th style="width: 10%;">{{ __('label.mobile') }}</th>
                <th style="width: 10%;">{{ __('label.branch') }}</th>
                <th style="width: 10%;">{{ __('label.total_invoice_not_paid') }}</th>
                <th style="display: none;">{{ __('label.mobile') }}</th>
                <th style="display: none;">{{ __('label.email') }}</th>
                <th style="display: none;">{{ __('label.name') }}</th>
                <th style="width: 8%;">{{ __('label.total_contracts') }}</th>
                <th style="width: 10%;">{{ __('label.total_income') }}</th>
                <th style="width: 8%;">{{ __('label.total_work_hours') }}</th>
                <th style="width: 8%;">{{ __('label.placement_date') }}</th>
                <th style="width: 8%;">{{ __('label.code_internet') }}</th>
                <th style="width: 8%;">{{ __('label.whatsapp') }}</th>
                <th style="width: 20%;">{{ __('label.actions') }}</th>
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
    @include('components.invoice.index')
    @include('components.invoice.add_edit_invoice')

    @include('components.internetSubscriptions.add_edit')



    @include('components.notifications.notification')

    @include('admin.users.modal.user_details')
    @include('admin.users.modal.add')
    @include('admin.workSpaceMangements.deskMangments.modal.release')
    @include('admin.users.modal.services')

    @include('admin.users.modal.add_service')

@endsection

@push('scripts')
    @include('admin.users.js.index')
@endpush

<!--end::Datatable-->
