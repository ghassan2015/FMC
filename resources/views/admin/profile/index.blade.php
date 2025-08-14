@extends('admin.layouts.master')
@section('main_title','بيانات الملف الشخصي')
@section('main_page','الملف الشخصي')
@section('title','الملف الشخصي')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

        <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->

        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">بيانات الشخصية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">تغير كلمة المرور</a>
            </li>

        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                <form id="kt_account_profile_details_form" class="form" enctype="multipart/form-data" method="Post">
                     @csrf
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">الصورة</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{asset('assets/media/svg/avatars/blank.svg')}}')">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{auth('admin')->user()->getAttachment()}})"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
																	<i class="ki-duotone ki-cross fs-2">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
																	<i class="ki-duotone ki-cross fs-2">
																		<span class="path1"></span>
																		<span class="path2"></span>
																	</i>
																</span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">الاسم</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="" value="{{auth('admin')->user()->name}}" />


                                        <div class="name text-danger"> </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->

                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">الايميل</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="example@example.com" value="{{auth('admin')->user()->email}}" />
                                <div class="email text-danger"> </div>

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                <span class="required">رقم الجوال</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
																<i class="ki-duotone ki-information-5 text-gray-500 fs-6">
																	<span class="path1"></span>
																	<span class="path2"></span>
																	<span class="path3"></span>
																</i>
															</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="mobile" class="form-control form-control-lg form-control-solid" placeholder="044 3276 454 935" value="{{auth('admin')->user()->mobile}}" />
                                <div class="mobile text-danger"> </div>

                            </div>
                            <!--end::Col-->
                        </div>


                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" form="kt_account_profile_details_form" id="submit-button">تاكيد</button>
                        <div id="spinner" class="spinner-border text-primary" role="status" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <!--end::Actions-->
                </form>

            </div>
            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">

                <form id="kt_account_profile_password_form" class="form" enctype="multipart/form-data" method="Post">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Input group-->
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">كلمة المرور الحالية</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Row-->
                                <div class="row">
                                    <!--begin::Col-->
                                    <div class="col-lg-12 fv-row">
                                        <input type="password" name="current_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="*********"  />


                                        <div class="current_password text-danger"> </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->

                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">كلمة المرور الجديدة</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="new_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="*********"  />
                                <div class="new_password text-danger"> </div>

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->

                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">تاكيد كلمة المرور</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="confirm_new_password" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="*********"  />
                                <div class="confirm_new_password text-danger"> </div>

                            </div>
                            <!--end::Col-->
                        </div>


                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" form="kt_account_profile_password_form" id="password_submit-button">تاكيد</button>
                        <div id="password_spinner" class="spinner-border text-primary" role="status" style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>







        </div>
        </div>
@endsection


@push('scripts')
    @include('admin.profile.js.js')
@endpush
