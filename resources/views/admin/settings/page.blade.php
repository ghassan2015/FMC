@extends('admin.layouts.master')

@section('title', __('label.settings'))
@section('toolbarSubTitle', __('label.settings'))
@section('toolbarPage', __('label.page_settings'))


@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Row-->
        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->

                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <form action="{{ route('admin.settings.updatePages') }}" method="POST" enctype="multipart/form-data"
                        id="page-form" name="page-form">
                        @csrf

                        <!-- Name Fields -->
                        <div class="row mb-5" style="height: 600px">
                            <div class="col-md-6">
                                <label class="form-label required" for="about_us_ar">{{ __('label.about_us') }}
                                    (AR)</label>
                                <div name="about_us_ar" class="form-control about_us_ar" id="about_us_ar" required>
                                    {!! settings('page', 'about_us')->getTranslation('value', 'ar') !!}
                                </div>
                                <div class="about_us_ar error"></div>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required" for="about_us_en">{{ __('label.about_us') }}
                                    (EN)</label>
                                <div name="about_us_en" class="form-control about_us_en" id="about_us_en" required>
                                    {!! settings('page', 'about_us')->getTranslation('value', 'en') !!}
                                </div>
                                <div class="about_us_en error"></div>
                            </div>

                        </div>
                        <!-- Description Fields -->


                        <div class="row mb-5" style="height: 600px">
                            <div class="col-md-6">
                                <label class="form-label required" for="term_condition_ar">{{ __('label.term_condition') }}
                                    (AR)
                                </label>
                                <div name="term_condition_ar" class="form-control term_condition_ar" id="term_condition_ar"
                                    required>
                                    {!! settings('page', 'term_condition')->getTranslation('value', 'ar') !!}
                                </div>
                                <div class="term_condition_ar error"></div>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required" for="term_condition_en">{{ __('label.term_condition') }}
                                    (EN)
                                </label>
                                <div name="term_condition_en" class="form-control term_condition_en" id="term_condition_en"
                                    required>
                                    {!! settings('page', 'term_condition')->getTranslation('value', 'en') !!}

                                </div>
                                <div class="term_condition_en error">


                                </div>
                            </div>

                        </div>



                        <div class="row mb-5" style="height: 600px">
                            <div class="col-md-6">
                                <label class="form-label required" for="privacy_policy_ar">{{ __('label.privacy_policy') }}
                                    (AR)</label>
                                <div name="privacy_policy_ar" class="form-control privacy_policy_ar" id="privacy_policy_ar"
                                    required>
                                    {!! settings('page', 'privacy_policy')->getTranslation('value', 'ar') !!}

                                </div>
                                <div class="privacy_policy_ar error"></div>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label required" for="term_condition_en">{{ __('label.privacy_policy') }}
                                    (EN)
                                    </label>
                                <div name="privacy_policy_en" class="form-control privacy_policy_en" id="privacy_policy_en"
                                    required>
                                    {!! settings('page', 'privacy_policy')->getTranslation('value', 'en') !!}

                                </div>
                                <div class="privacy_policy_en error"></div>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-button">{{ __('label.submit') }}
                            </button>
                            <div id="spinner" class="spinner-border text-primary" role="status" style="display:none;">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Card body-->
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @include('admin.settings.js.general')
@endpush
