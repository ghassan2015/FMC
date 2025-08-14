@extends('admin.layouts.master')

@section('title', __('label.settings'))
@section('toolbarSubTitle', __('label.setting_list'))
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
                            <div class="col-md-12">
                                <label for="name" class="form-label">اسم المؤسسة<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="name" name="name"
                                    value="{{ settings('general', 'name')->value ?? '' }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <!-- Description Fields -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">وصف الموقع <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" class="form-control form-control-solid"> {{ settings('general', 'description')->value ?? '' }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="name" class="form-label">رقم الواتس اب<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-solid" id="whatsapp" name="whatsapp"
                                    value="{{ settings('general', 'whatsapp')->value ?? '' }}" required>
                                @error('whatsapp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <!-- Name Fields -->
                 
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="logo" class="form-label">صورة الموقع</label>
                                <input type="file" class="form-control" id="logo" name="logo"
                                    onchange="previewImage(event)">
                                <div class="mb-3">
                                    @php
                                    $logo = settings('general', 'logo')->value ?? '';
                                    $logoSrc = Str::startsWith($logo, 'settings/')
                                                    ? asset('storage/' . $logo)
                                                    : $logo;
                                    @endphp

                                <img id="image-preview"
                                     src="{{ $logoSrc }}"
                                     alt="Image Preview"
                                     style="max-width: 100px;">


                                </div>
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="cover_logo" class="form-label">صورة الغلاف</label>
                                <input type="file" class="form-control form-control-solid" id="cover_logo"
                                    name="cover_logo" onchange="previewSecondaryImage(event)">
                                    <div class="mb-3">
                                        @php
                                        $logo = settings('general', 'cover_logo')->value ?? '';
                                        $logoSrc = Str::startsWith($logo, 'settings/')
                                                        ? asset('storage/' . $logo)
                                                        : $logo;
                                        @endphp

                                    <img id="image-preview"
                                         src="{{ $logoSrc }}"
                                         alt="Image Preview"
                                         style="max-width: 100px;">


                                    </div>
                                @error('cover_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <label for="icon_logo" class="form-label">ايقونة الموقع</label>
                                <input type="file" class="form-control form-control-solid" id="icon_logo"
                                    name="icon_logo" onchange="previewThirtyImage(event)">
                                    <div class="mb-3">
                                        @php
                                        $logo = settings('general', 'icon_logo')->value ?? '';
                                        $logoSrc = Str::startsWith($logo, 'settings/')
                                                        ? asset('storage/' . $logo)
                                                        : $logo;
                                        @endphp

                                    <img id="image-preview"
                                         src="{{ $logoSrc }}"
                                         alt="Image Preview"
                                         style="max-width: 100px;">


                                    </div>
                                @error('icon_logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>



                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="submit-button">تاكيد </button>
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
