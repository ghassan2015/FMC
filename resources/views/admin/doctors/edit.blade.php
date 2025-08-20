@extends('admin.layouts.master')
@section('title', __('label.edit_doctor'))
@section('toolbarSubTitle', __('label.doctors_list'))
@section('toolbarPage', __('label.edit_doctor'))

@section('content')
    <style>
        .image-input-placeholder {
            background-image: url('svg/avatars/blank.svg');
        }

        [data-bs-theme="dark"] .image-input-placeholder {
            background-image: url('svg/avatars/blank-dark.svg');
        }
    </style>

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card">
            <div class="card-body p-lg-17">
                <form id="my-form" method="POST" action="{{ route('admin.doctors.update') }}" enctype="multipart/form-data">
                    @csrf


                    {{-- Name & Email --}}
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.name') }}</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $doctor->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="text-danger name"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.email') }}</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $doctor->email) }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="text-danger email"></div>
                        </div>
                    </div>

                    {{-- Mobile & Password --}}
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.mobile') }}</label>
                            <input type="text" name="mobile" class="form-control"
                                value="{{ old('mobile', $doctor->mobile) }}" required>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="text-danger mobile"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('label.password') }}</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="text-danger password"></div>
                        </div>
                    </div>

                    {{-- About Us --}}
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required" for="about_us_ar">{{ __('label.aboutus_doctor') }}
                                (AR)</label>
                            <textarea name="about_us_ar" class="form-control" id="about_us_ar" required>{{ old('about_us_ar', $doctor->getTranslation('about_us', 'ar')) }}</textarea>
                            <div class="about_us_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required" for="about_us_en">{{ __('label.aboutus_doctor') }}
                                (EN)</label>
                            <textarea name="about_us_en" class="form-control" id="about_us_en" required>{{ old('about_us_en', $doctor->getTranslation('about_us', 'en')) }}</textarea>
                            <div class="about_us_en error"></div>
                        </div>
                    </div>

                    {{-- License, Branch, Specialization --}}
                    <div class="row mb-5">
                        <div class="col-md-4">
                            <label class="form-label required">{{ __('label.license_number') }}</label>
                            <input type="text" name="license_number" class="form-control"
                                value="{{ old('license_number', $doctor->license_number) }}" required>
                            @error('license_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="text-danger license_number"></div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">{{ __('label.branches') }}</label>
                            <select class="form-select form-select-solid" name="branch_id[]" multiple required
                                data-control="select2">
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}"
                                        {{ in_array($value->id, old('branch_id', $doctor->branches->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="branch_id error"></div>

                        </div>

                        <div class="col-md-4">
                            <label class="form-label required">{{ __('label.specializations') }}</label>
                            <select class="form-select form-select-solid" name="specialization_id" required
                                data-control="select2">
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($specializations as $value)
                                    <option value="{{ $value->id }}"
                                        {{ old('specialization_id', $doctor->specialization_id) == $value->id ? 'selected' : '' }}>
                                        {{ $value->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="specialization_id error"></div>

                        </div>
                    </div>

                    {{-- Avatar --}}
                    <div class="row mb-5">
                        <div class="col-md-12 ">
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}'); margin: auto;">
                                <div class="image-input-wrapper w-125px h-125px" id="logoPreview"
                                    style="background-image: url('{{ $doctor->avatar ? asset('storage/' . $doctor->avatar) : asset('assets/default.png') }}');">
                                </div>

                                <!-- Change -->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    title="{{ __('label.change_avatar') }}">
                                    <i class="ki-duotone ki-pencil fs-7"></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .webp" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>

                                <!-- Cancel -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 start-0 translate-middle"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                    title="{{ __('label.cancel_avatar') }}">
                                    <i class="ki-duotone ki-cross fs-2"></i>
                                </span>

                                <!-- Remove -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                    title="{{ __('label.remove_avatar') }}">
                                    <i class="ki-duotone ki-trash fs-2"></i>
                                </span>
                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle"></i> {{ __('label.allowed_file_types') }}: jpg, png, jpeg,
                                webp
                            </div>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="row mb-5">
                        <label for="image" class="form-label required d-block mb-2">{{ __('label.status') }}</label>
                        <div class="col-md-6 d-flex align-items-center mb-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status"
                                    value="1" {{ old('status', $doctor->admin?->is_active) ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" value="{{ $doctor->id }}" name="doctor_id">
                    <input type="hidden" value="{{ $doctor->admin_id }}" name="admin_id">

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane me-1"></i>
                            <span id="spinner" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i>
                            </span>
                            {{ __('label.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @include('admin.doctors.scripts.edit')
@endpush
