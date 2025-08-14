@extends('admin.layouts.master')
@section('title', __('label.edit_user'))
@section('toolbarSubTitle', __('label.user_list'))
@section('toolbarPage', __('label.edit_user'))

@section('content')
    <div class="card">
        <form id="my-form" name="my-form" action="{{ route('admin.users.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="row g-3">
                    <!-- الاسم -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">{{ __('label.name') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">{{ __('label.email') }} <span
                                class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الجوال -->
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">{{ __('label.mobile') }} <span
                                class="text-danger">*</span></label>
                        <input type="tel" class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                            name="mobile" value="{{ old('mobile', $user->mobile) }}" required>
                        @error('mobile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- واتساب -->
                    <div class="col-md-6">
                        <label for="whatsapp" class="form-label">{{ __('label.whatsapp') }} <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp"
                            name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" required>
                        @error('whatsapp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- نوع المستخدم -->
                    <div class="col-md-6">
                        <label for="user_type_id" class="form-label">{{ __('label.user_type') }} <span
                                class="text-danger">*</span></label>
                        <select class="form-select form-select-solid
                                   @error('user_type_cd_id') is-invalid @enderror"   data-control="select2"
                            id="user_type_id" name="user_type_cd_id" required>
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($userTypes as $value)
                                <option value="{{ $value->id }}" @if (old('user_type_cd_id', $user->user_type_id) == $value->id) selected @endif>
                                    {{ $value->value }}</option>
                            @endforeach
                        </select>
                        @error('user_type_cd_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- التخصص -->
                    <div class="col-md-6" id="specialization_box">
                        <label for="specialization_id" class="form-label">{{ __('label.specializations') }} <span
                                class="text-danger">*</span></label>
                        <select

                        class="form-select form-select-solid
                                   @error('specialization_id') is-invalid @enderror"   data-control="select2"

                            name="specialization_id" required>
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($specializations as $value)
                                <option value="{{ $value->id }}" @if (old('specialization_id', $user->specialization_id) == $value->id) selected @endif>
                                    {{ $value->title }}</option>
                            @endforeach
                        </select>
                        @error('specialization_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- كلمة المرور -->
                    <div class="col-md-6">
                        <label for="password" class="form-label">{{ __('label.password') }}</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- القراءة الأولية -->


                    <!-- الحضور في مقر العمل -->
                    <div class="col-md-6" id="attendance_box">
                        <label for="workplace_attendance" class="form-label">{{ __('label.workplace_attendance') }}</label>
                        <select  class="form-control @error('workplace_attendance') is-invalid @enderror" data-control="select2"
                            id="workplace_attendance" name="workplace_attendance" required>
                            <option value="">{{ __('label.selected') }}</option>
                            <option value="full_time" @if (old('workplace_attendance', $user->workplace_attendance) == 'full_time') selected @endif>
                                {{ __('label.full_time') }}</option>
                            <option value="part_time" @if (old('workplace_attendance', $user->workplace_attendance) == 'part_time') selected @endif>
                                {{ __('label.part_time') }}</option>
                        </select>
                        @error('workplace_attendance')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الجامعة -->
                    <div class="col-md-6" id="university_box">
                        <label for="university_cd_id" class="form-label">{{ __('label.university') }} <span
                                class="text-danger">*</span></label>
                        <select  class="form-control @error('university_cd_id') is-invalid @enderror" id="university_cd_id"
                            name="university_cd_id" required data-control="select2">
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($universities as $value)
                                <option value="{{ $value->id }}" @if (old('university_cd_id', $user->university_cd_id) == $value->id) selected @endif>
                                    {{ $value->value }}</option>
                            @endforeach
                        </select>
                        @error('university_cd_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- مكان الإقامة الأصلي -->
                    <div class="col-md-6">
                        <label for="original_place" class="form-label">{{ __('label.original_place') }} <span
                                class="text-danger">*</span></label>
                        <select data-control="select2" class="form-control @error('original_place') is-invalid @enderror" id="original_place"
                            name="original_place" required>
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach (['شمال غزة', 'مدينة غزة', 'الوسطى', 'خانيونس', 'رفح'] as $place)
                                <option value="{{ $place }}" @if (old('original_place', $user->original_place) == $place) selected @endif>
                                    {{ __($place) }}</option>
                            @endforeach
                        </select>
                        @error('original_place')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الحالة -->
                    <div class="col-md-6">
                        <label for="status" class="form-label">{{ __('label.status') }}</label>
                        <select data-control="select2" class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="0" @if ($user->status == 0) selected @endif>
                                {{ __('label.account_disabled') }}</option>
                            <option value="1" @if ($user->status == 1) selected @endif>
                                {{ __('label.user_in_incubator') }}</option>
                            <option value="3" @if ($user->status == 3) selected @endif>
                                {{ __('label.user_out_incubator') }}</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الفرع -->
                    <div class="col-md-6" id="branch_div">
                        <label for="branch_id" class="form-label">{{ __('label.branches') }}</label>
                        <select data-control="select2" class="form-control @error('branch_id') is-invalid @enderror" id="branch_id"
                            name="branch_id">
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}" @if (old('branch_id', $user->branch_id) == $value->id) selected @endif>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- الصورة الشخصية -->
                    <div class="col-md-6">
                        <label for="photo" class="form-label">{{ __('label.photo') }} <span
                                class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                            name="photo">
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        @if ($user->photo)
                            <div class="mt-2">
                                <a href="{{ $user->photo }}" target="_blank">
                                    <img src="{{ $user->photo }}" class="img-thumbnail" style="width: 100px;">
                                </a>
                            </div>
                        @endif
                    </div>
                </div>



            </div>
            <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane me-1"></i> {{ __('label.submit') }}
                        <span id="spinner" style="display:none;"><i class="fa fa-spinner fa-spin"></i></span>
                    </button>
        </form>
    </div>
    </div>
@endsection

@push('scripts')

@include('admin.users.js.edit_create')
@endpush
