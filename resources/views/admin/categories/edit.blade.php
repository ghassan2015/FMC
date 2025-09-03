@extends('admin.layouts.master')
@section('title', __('label.edit_category'))
@section('toolbarSubTitle', __('label.categories_list'))
@section('toolbarPage', __('label.edit_category'))

@section('content')
    <style>
        .ql-container {
            min-height: 150px;
            /* لضبط الارتفاع الافتراضي */
            max-height: 400px;
            /* حتى لا يكبر كثير */
            overflow-y: auto;
        }
    </style>
    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-body p-lg-17">
                <form id="my-form" method="POST" action="{{ route('admin.categories.update') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Name AR / EN -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.name') }} (AR)</label>
                            <input type="text" name="name_ar" class="form-control"
                                value="{{ $category->getTranslation('name', 'ar') }}" required>

                            <div class="name_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.name') }} (EN)</label>
                            <input type="text" name="name_en" class="form-control"
                                value="{{ $category->getTranslation('name', 'ar') }}" required>
                            <div class="name_en error"></div>

                        </div>
                    </div>

                    <!-- Parent Category -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.parent_category') }}</label>
                            <select name="parent_category_id"class="form-select form-select-solid" data-control="select2">
                                <option value="0">{{ __('label.main_category') }}</option>
                                @foreach ($categories as $value)
                                    <option value="{{ $value->id }}"
                                        {{ $value->id == $category->parent_category_id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="parent_category_id error"></div>

                        </div>
                        <input type="hidden" name="category_id" class="form-control" value="{{ $category->id }}">

                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.video_url') }}</label>
                            <input type="url" name="video" class="form-control" value="{{ $category->video }}">
                            <div class="video error"></div>

                        </div>
                    </div>

                    <!-- Description AR / EN -->
                    <div class="row mb-5" style="height: 500px">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.description') }} (AR)</label>
                            <div id="description_ar">{!! $category->getTranslation('description', 'ar') !!}</div>

                            <div class="description_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.description') }} (EN)</label>
                            <div id="description_en">{!! $category->getTranslation('description', 'en') !!}</div>
                            <div class="description_en error"></div>

                        </div>
                    </div>

                    <!-- Signs AR / EN -->
                    <div class="row mb-5" style="height: 500px">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.signs') }} (AR)</label>
                            <div id="signs_ar">{!! $category->getTranslation('signs', 'ar') !!}</div>
                            <div class="signs_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.signs') }} (EN)</label>
                            <div id="signs_en">{!! $category->getTranslation('signs', 'em') !!}</div>
                            <div class="signs_en error"></div>

                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.reason') }} (AR)</label>
                            <textarea class="form-control" name="reason_ar" id="reason_ar">{{ $category->getTranslation('reason', 'ar') }}</textarea>
                            <div class="reason_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.reason') }} (EN)</label>
                            <textarea class="form-control" name="reason_en" id="reason_en">{{ $category->getTranslation('reason', 'ar') }}</textarea>
                            <div class="reason_en error"></div>

                        </div>
                    </div>





                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label" for="disease_type_ar">{{ __('label.disease_type') }} (AR)</label>
                            <textarea class="form-control" name="disease_type_ar" id="disease_type_ar">{{ $category->getTranslation('disease_type', 'ar') }}</textarea>
                            <div class="disease_type_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label"for="disease_type_en">{{ __('label.disease_type') }} (EN)</label>
                            <textarea class="form-control" name="disease_type_en" id="disease_type_en">{{ $category->getTranslation('disease_type', 'en') }}</textarea>
                            <div class="disease_type_en error"></div>

                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.surgery_therapy') }} (AR)</label>
                            <textarea class="form-control" name="surgery_therapy_ar" id="surgery_therapy_ar">{{ $category->getTranslation('surgery_therapy', 'ar') }}</textarea>
                            <div class="surgery_therapy_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.surgery_therapy') }} (EN)</label>
                            <textarea class="form-control" name="surgery_therapy_en" id="surgery_therapy_en">{{ $category->getTranslation('surgery_therapy', 'en') }}</textarea>
                            <div class="surgery_therapy_en error"></div>

                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.surgery_type') }} (AR)</label>
                            <textarea class="form-control" name="surgery_type_ar"id="surgery_type_ar">{{ $category->getTranslation('surgery_type', 'ar') }}</textarea>

                            <div class="surgery_type_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.surgery_type') }} (EN)</label>
                            <textarea class="form-control" name="surgery_type_en" id="surgery_type_en">{{ $category->getTranslation('surgery_type', 'en') }}</textarea>
                            <div class="surgery_type_en error"></div>

                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.preparing_operation') }} (AR)</label>
                            <textarea class="form-control" name="preparing_operation_ar" id="preparing_operation_ar">{{ $category->getTranslation('preparing_operation', 'ar') }}}</textarea>
                            <div class="preparing_operation_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.preparing_operation') }} (EN)</label>
                            <textarea class="form-control" name="preparing_operation_en" id="preparing_operation_en">{{ $category->getTranslation('preparing_operation', 'en') }}</textarea>
                            <div class="preparing_operation_en error"></div>

                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.payment_type') }} (AR)</label>
                            <textarea class="form-control" name="payment_type_ar" id="payment_type_ar">{{ $category->getTranslation('payment_type', 'ar') }}</textarea>
                            <div class="payment_type_ar error"></div>

                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.payment_type') }} (EN)</label>
                            <textarea class="form-control" name="payment_type_en" id="payment_type_en">{{ $category->getTranslation('payment_type', 'en') }}</textarea>
                            <div class="payment_type_en error"></div>

                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.operation_pirce') }} (AR)</label>
                            <input type="text" name="operation_pirce_ar" class="form-control"
                                value="{{ $category->getTranslation('operation_pirce', 'ar') }}">

                            <div class="operation_pirce_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.operation_pirce') }} (EN)</label>
                            <input type="text" name="operation_pirce_en" class="form-control"
                                value="{{ $category->getTranslation('operation_pirce', 'en') }}">
                            <div class="operation_pirce_en error"></div>

                        </div>
                    </div>

                    <!-- Photo -->

                    <!-- Status -->



                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label class="form-label">{{ __('label.before_surgical_images') }}</label>
                            <div class="dropzone" id="beforeSurgicalDropzone"></div>

                        </div>


                    </div>
                    <div class="row mb-5">

                        <div class="col-md-12">
                            <label class="form-label">{{ __('label.after_surgical_images') }}</label>
                            <div class="dropzone" id="afterSurgicalDropzone"></div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-12 ">
                                <label class="form-label fw-semibold fs-6">{{ __('label.logo') }}</label>
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}'); margin: auto;">

                                    <div class="image-input-wrapper w-125px h-125px" id="logoPreview"
                                        style="background-image: url({{ $category->photo }});"></div>

                                    <!-- Change -->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="{{ __('label.change_avatar') }}">
                                        <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                                class="path2"></span></i>
                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .webp" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>

                                    <!-- Cancel -->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 start-0 translate-middle"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="{{ __('label.cancel_avatar') }}">
                                        <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>

                                    <!-- Remove -->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="{{ __('label.remove_avatar') }}">
                                        <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>
                                </div>
                                <div class="form-text mt-2">
                                    <i class="fas fa-info-circle"></i> {{ __('label.allowed_file_types') }}: jpg, png,
                                    jpeg,
                                    webp
                                </div>
                                <div class="avatar error"></div>
                            </div>

                        </div>


                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label">{{ __('label.status') }}</label>
                                <label class="form-switch">
                                    <input class="form-check-input" name="is_active" id="is_active" value="1"
                                        type="checkbox" @if ($category->is_active) checked @endif>
                                    <span class="form-check-label"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                    <!-- Submit -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            {{ __('label.submit') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    @include('admin.categories.js.edit')
@endpush
