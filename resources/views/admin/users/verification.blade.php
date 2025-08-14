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

    <!-- Datatable -->
    <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th style="width: 4%;"></th>
                <th>{{ __('label.name') }} </th>
                <th>{{ __('label.id_number') }} </th>
                <th>{{ __('label.birth_date') }} </th>
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




    <div class="modal fade" id="acceptStatusModal" tabindex="-1" role="dialog" aria-labelledby="acceptStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title status_user" id="exampleModalLabel">{{ __('label.status_user') }}</h1>
                    <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </button>
                </div>
                <form id="acceptStatusForm" name="acceptStatusForm" method="POST" action="">
                    @csrf

                    <div class="modal-body">
                        <p class="text-primary mt-3">بقبولك لهذا الطلب سيتم تفعيل الملف الشخصي لهذا المستخدم.</p>
                        <input type="hidden" name="user_id" id="edit_verification_user_id" value="">
                        <input type="hidden" name="is_verification" id="is_verification" value="1">


                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="send_form" class="btn btn-primary">
                            <i class="fa fa-paper-plane hiden_icon" aria-hidden="true"></i>
                            <span id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin" style="font-size: 16px;"></i>
                            </span>
                            {{ __('label.submit') }}
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa fa-window-close" aria-hidden="true"></i>
                            {{ __('label.cancel') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    </div>


    <!-- Modal for showing the image -->
    <div class="modal fade" id="idPhotoModal" tabindex="-1" role="dialog" aria-labelledby="idPhotoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idPhotoModalLabel">{{ __('label.id_photo') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('label.close') }}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalIdPhoto" src="" alt="{{ __('label.id_photo') }}"
                        style="max-width:100%;max-height:400px;">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin.users.js.verification')
@endpush
