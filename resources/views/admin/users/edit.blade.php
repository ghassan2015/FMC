@extends('admin.layouts.master')

@section('title', __('label.edit_user'))
@section('toolbarSubTitle', __('label.user_list'))
@section('toolbarPage', __('label.edit_user'))

@section('content')
<div class="card">
    <div class="card-body">
        <form id="my-form"
              action="{{ route('admin.users.update') }}"
              name="my-form"
              method="POST"
              enctype="multipart/form-data"
              autocomplete="off">
            @csrf

            <input type="hidden" value="{{$user->id}}" name="user_id">
            <div class="row g-3">
                <!-- الاسم -->
                <div class="col-md-6">
                    <label for="name" class="form-label required">{{ __('label.name') }}</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name', $user->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- البريد الإلكتروني -->
                <div class="col-md-6">
                    <label for="email" class="form-label required">{{ __('label.email') }}</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email', $user->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                    >
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- الجوال -->
                <div class="col-md-6">
                    <label for="mobile" class="form-label required">{{ __('label.mobile') }}</label>
                    <input
                        type="tel"
                        name="mobile"
                        id="mobile"
                        value="{{ old('mobile', $user->mobile) }}"
                        class="form-control @error('mobile') is-invalid @enderror"
                        required
                    >
                    @error('mobile')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- رقم الهوية -->
                <div class="col-md-6">
                    <label for="id_number" class="form-label required">{{ __('label.id_number') }}</label>
                    <input
                        type="text"
                        name="id_number"
                        id="id_number"
                        value="{{ old('id_number', $user->id_number) }}"
                        class="form-control @error('id_number') is-invalid @enderror"
                        required
                    >
                    @error('id_number')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- تاريخ الميلاد -->
                <div class="col-md-6">
                    <label for="birth_date" class="form-label required">{{ __('label.birth_date') }}</label>
                    <input
                        type="text"
                        name="birth_date"
                        id="birth_date"
                        value="{{ old('birth_date', $user->birth_date) }}"
                        class="form-control kt_datepicker @error('birth_date') is-invalid @enderror"
                    >
                    @error('birth_date')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- الصورة الشخصية -->
            <div class="row mt-4 mb-5">
                <div class="col-md-12">
                    <label class="form-label fw-semibold fs-6">{{ __('label.logo') }}</label>
                    <div class="image-input image-input-outline" data-kt-image-input="true"
                         style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}'); margin: auto;">

                        <div class="image-input-wrapper w-125px h-125px" id="logoPreview"
                             style="background-image: url('{{ $user->photo ? $user->photo : asset('assets/default.png') }}');"></div>

                        <!-- Change -->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                               data-kt-image-input-action="change" data-bs-toggle="tooltip"
                               title="{{ __('label.change_avatar') }}">
                            <i class="ki-duotone ki-pencil fs-7"></i>
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .webp" />
                            <input type="hidden" name="avatar_remove" />
                        </label>

                        <!-- Cancel -->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 start-0 translate-middle"
                              data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                              title="{{ __('label.cancel_avatar') }}">
                            <i class="ki-duotone ki-cross fs-2"></i>
                        </span>

                        <!-- Remove -->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                              data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                              title="{{ __('label.remove_avatar') }}">
                            <i class="ki-duotone ki-trash fs-2"></i>
                        </span>
                    </div>

                    <div class="form-text mt-2">
                        <i class="fas fa-info-circle"></i>
                        {{ __('label.allowed_file_types') }}: jpg, png, jpeg, webp
                    </div>
                    <div class="avatar error"></div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save me-1"></i> {{ __('label.submit') }}
                <span id="spinner" style="display:none;">
                    <i class="fa fa-spinner fa-spin"></i>
                </span>
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.users.js.edit_create')
@endpush
