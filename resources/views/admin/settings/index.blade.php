@extends('admin.layouts.master')

@section('title', __('label.settings'))
@section('toolbarSubTitle', __('label.settings'))
@section('toolbarPage', __('label.general_settings'))


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
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
                        id="my-form" name="my-form">
                        @csrf

                        <!-- Name Fields -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name_ar" class="form-label">{{ __('label.name') }} (AR)<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="name_ar" name="name_ar"
                                    value="{{ settings('general', 'name')->getTranslation('value', 'ar') }}" required>


                                @error('name_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="name_ar error"></div>

                            </div>


                            <div class="col-md-6">
                                <label for="name_en" class="form-label">{{ __('label.name') }} (EN)<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="name_en" name="name_en"
                                    value="{{ settings('general', 'name')->getTranslation('value', 'en') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="name_en error"></div>



                        </div>

                        <!-- Description Fields -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="description" class="form-label">{{ __('label.description') }} (AR) <span
                                        class="text-danger">*</span></label>
                                <textarea name="description_ar" class="form-control form-control-solid"> {{ settings('general', 'description')->getTranslation('value', 'ar') ?? '' }}</textarea>
                                <div class="description_ar error"></div>

                                @error('description_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-6">
                                <label for="description" class="form-label">{{ __('label.description') }} (EN) <span
                                        class="text-danger">*</span></label>
                                <textarea name="description_en" class="form-control form-control-solid"> {{ settings('general', 'description')->getTranslation('value', 'en') ?? '' }}</textarea>

                                @error('description_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="description_en error"></div>

                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('label.whatsapp') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="whatsapp" name="whatsapp"
                                    value="{{ settings('contact_us', 'whatsapp')->getTranslation('value', 'ar') ?? '' }}"
                                    required>

                                @error('whatsapp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="whatsapp error"></div>

                            </div>


                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('label.email') }}<span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-solid" id="email" name="email"
                                    value="{{ settings('contact_us', 'email')->getTranslation('value', 'ar') ?? '' }}"
                                    required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="email error"></div>

                            </div>

                        </div>


                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">{{ __('label.mobile') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="mobile" name="mobile"
                                    value="{{ settings('contact_us', 'mobile')->getTranslation('value', 'ar') ?? '' }}"
                                    required>
                                @error('mobile')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="mobile error"></div>

                            </div>

                            <div class="col-md-6">
                                <label for="facebook" class="form-label">{{ __('label.facebook') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="facebook" name="facebook"
                                    value="{{ settings('contact_us', 'facebook')->getTranslation('value', 'ar') ?? '' }}"
                                    required>
                                @error('facebook')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="facebook error"></div>

                            </div>




                        </div>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <label for="location_ar" class="form-label">{{ __('label.location') }} (AR)<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="location_ar"
                                    name="location_ar"
                                    value="{{ settings('contact_us', 'location')->getTranslation('value', 'ar') ?? '' }}"
                                    required>
                                @error('location_ar')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                                <div class="location_ar error"></div>
                            </div>

                            <div class="col-md-6">
                                <label for="location_en" class="form-label">{{ __('label.location') }} (AR)<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="location_en"
                                    name="location_en"
                                    value="{{ settings('contact_us', 'location')->getTranslation('value', 'en') }}"
                                    required>
                                @error('location_en')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="location_en error"></div>

                            </div>

                        </div>

                        <!-- Name Fields -->

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="logo" class="form-label">{{ __('label.logo') }}</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                    onchange="previewImage(event)">
                                <div class="mb-3">
                                    @php
                                        $logo = settings('general', 'logo')->getTranslation('value', 'en') ?? '';
                                        $logoSrc = Str::startsWith($logo, 'settings/')
                                            ? asset('storage/' . $logo)
                                            : $logo;
                                    @endphp

                                    <img id="image-preview" src="{{ $logoSrc }}" alt="Image Preview"
                                        style="max-width: 100px;">


                                </div>
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="logo error"></div>

                            </div>


                            <div class="col-md-6">
                                <label for="cover_logo" class="form-label">{{ __('label.cover_logo') }}</label>
                                <input type="file" class="form-control form-control-solid" id="cover_logo"
                                    name="cover_logo" onchange="previewSecondaryImage(event)">
                                <div class="mb-3">
                                    @php
                                        $logo = settings('general', 'cover_logo')->value ?? '';
                                        $logoSrc = Str::startsWith($logo, 'settings/')
                                            ? asset('storage/' . $logo)
                                            : $logo;
                                    @endphp

                                    <img id="secondary-image-preview" src="{{ $logoSrc }}" alt="Image Preview"
                                        style="max-width: 100px;">

                                    <div class="cover_logo error"></div>

                                </div>
                                @error('cover_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <label for="icon_logo" class="form-label">{{ __('label.icon_logo') }}</label>
                                <input type="file" class="form-control form-control-solid" id="icon_logo"
                                    name="icon_logo" onchange="previewThirtyImage(event)">
                                <div class="mb-3">
                                    @php
                                        $logo = settings('general', 'icon_logo')->value ?? '';
                                        $logoSrc = Str::startsWith($logo, 'settings/')
                                            ? asset('storage/' . $logo)
                                            : $logo;
                                    @endphp

                                    <img id="three-image-preview" src="{{ $logoSrc }}" alt="Image Preview"
                                        style="max-width: 100px;">

                                    <div class="icon_logo error"></div>

                                </div>
                                @error('icon_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>



                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-button">{{ __('label.submit') }}
                            </button>
                            <div id="spinner" class="spinner-border text-primary" role="status"
                                style="display:none;">
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
