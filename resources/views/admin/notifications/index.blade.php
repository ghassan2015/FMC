@extends('admin.layouts.master')

@section('title', __('label.branches'))
@section('toolbarSubTitle', __('label.branches_list'))
@section('toolbarPage', __('label.display_all_branches'))

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <!--begin::Contact-->
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <form id="notifyForm" method="POST" action="{{ route('admin.notifications.store') }}">
                @csrf
                <div class="row mb-5">

                    <!-- نوع الإشعار -->
                    <div class="col-md-6">
                        <label class="form-label required">{{ __('label.nontification_type') }}</label>
                        <select class="form-select form-select-solid" data-control="select2"
                                name="nontification_type" id="nontification_type" required>
                            <option value="">{{ __('label.all') }}</option>
                            <option value="1">{{ __('label.doctor') }}</option>
                            <option value="2">{{ __('label.users') }}</option>
                        </select>
                        <span class="nontification_type error"></span>
                    </div>

                    <!-- اختيار الأطباء -->
                    <div class="col-md-6 doctors d-none">
                        <label class="form-label required">{{ __('label.doctors') }}</label>
                        <select class="form-select form-select-solid" id="doctor_id" data-control="select2"
                                name="doctor_id[]" multiple>
                            @foreach ($doctors as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="doctor_id error"></span>
                    </div>

                    <!-- اختيار المستخدمين -->
                    <div class="col-md-6 users d-none">
                        <label class="form-label required">{{ __('label.users') }}</label>
                        <select class="form-select form-select-solid" id="user_id" data-control="select2"
                                name="user_id[]" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="user_id error"></span>
                    </div>

                </div>

                <!-- حقل عنوان الإشعار -->
                <div class="row mb-5">
                    <div class="col-md-12">
                        <label class="form-label required">{{ __('label.title') }}</label>
                        <input type="text" class="form-control" name="title" placeholder="{{ __('label.title') }}" required>
                    </div>
                </div>

                <!-- حقل نص الإشعار -->
                <div class="row mb-5">
                    <div class="col-md-12">
                        <label class="form-label required">{{ __('label.description') }}</label>
                        <textarea class="form-control" name="description" rows="4" placeholder="{{ __('label.description') }}" required></textarea>
                    </div>
                </div>

                <!-- زر الإرسال -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="ki-duotone ki-send fs-3 me-1"></i> {{ __('label.send_notification') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @include('admin.notifications.js.index')

@endpush
