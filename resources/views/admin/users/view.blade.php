@extends('admin.layouts.master')
@section('title')
    {{ __('label.user') }}
@endsection


@section('content')
    <!--end::Header-->
    <!--begin::Content-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="{{ $user->photo }}" alt="image" />
                        <div
                            class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                        </div>
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#"
                                    class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>
                                <a href="#">
                                    <i class="ki-outline ki-verify fs-1 text-primary"></i>
                                </a>
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#"
                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $user->mobile }}</a>

                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                    <i class="ki-outline ki-sms fs-4"></i>{{ $user->email }}</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">


                            <!--begin::Menu-->
                            <div class="me-0">
                                <a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-flip="top-end">
                                    <i class="fa fa-ellipsis-v fs-5"></i>
                                </a>

                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
    menu-state-bg-light-primary fw-bold fs-7 w-175px py-4 px-2 start-3"
                                    data-kt-menu="true">


                                    {{-- تعديل المستخدم --}}
                                    @if (auth('admin')->user()->can('edit_users'))
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-user-edit text-warning"></i>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="menu-link px-2">
                                                {{ __('label.edit_user') }}
                                            </a>
                                        </div>
                                    @endif






                                    {{-- إرسال إشعار --}}
                                    <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                        <i class="fas fa-bell text-warning"></i>
                                        <a href="#" class="menu-link px-2 sned_notification"
                                            data-user_id="{{ $user->id }}">
                                            {{ __('label.notifications') }}
                                        </a>
                                    </div>








                                </div>

                                <!--end::Menu 3-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                            data-kt-countup-value="{{ $user->appointments()->count() }}">0
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.appointment_count') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                            data-kt-countup-value="{{ $user->surgicalOperations()->count() }}">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.surgical_operations') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{$user->medicalTestUsers()->count()}}">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.medical_test') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Progress-->

                        <!--end::Progress-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->
            <!--begin::Navs-->
            <!--begin::Tabs-->
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x fs-5 fw-bold mb-5" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                        type="button" role="tab" aria-controls="overview" aria-selected="true">
                        {{ __('label.overview') }}
                    </button>
                </li>
                @can('view_medical_test')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="medical_test-tab" data-bs-toggle="tab" data-bs-target="#medical_test"
                        type="button" role="tab" aria-controls="medical_test" aria-selected="false">
                        {{ __('label.medical_test') }}
                    </button>
                </li>
                @endcan
                                @can('view_surgical_operation')

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="surgical_operations-tab" data-bs-toggle="tab"
                        data-bs-target="#surgical_operations" type="button" role="tab"
                        aria-controls="surgical_operations" aria-selected="false">
                        {{ __('label.surgical_operations') }}
                    </button>
                </li>
                @endcan
                @can('view_appointment')
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="appointment-tab" data-bs-toggle="tab" data-bs-target="#appointment"
                        type="button" role="tab" aria-controls="appointment" aria-selected="false">
                        {{ __('label.appointment_list') }}
                    </button>
                </li>
                @endcan
                @can('view_drug_user')
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="drug-tab" data-bs-toggle="tab" data-bs-target="#drug" type="button"
                            role="tab" aria-controls="drug" aria-selected="false">
                            {{ __('label.drug_list') }}
                        </button>
                    </li>
                @endcan






            </ul>
            <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <!-- Overview Content -->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                            </div>
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="btn btn-sm btn-primary align-self-center">{{ __('label.edit_user') }}</a>
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.name') }}</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->name }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.email') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <span class="fw-semibold text-gray-800 fs-6">{{ $user->email }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.mobile') }}
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Phone number must be active">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <span class="fw-bold fs-6 text-gray-800 me-2">{{ $user->mobile }}</span>
                                    <span class="badge badge-success"></span>
                                </div>
                            </div>


                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.id_number') }}</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->id_number }}</span>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.birth_date') }}</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->birth_date }}</span>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="tab-pane fade" id="medical_test" role="tabpanel" aria-labelledby="medical_test-tab">


                    @include('components.medicalTests.table')

                </div>




                <div class="tab-pane fade" id="surgical_operations" role="tabpanel"
                    aria-labelledby="surgical_operations-tab">
                    @include('components.surgicalOperations.table')
                </div>



                <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab">

                    @include('components.appointments.table')

                </div>




                <div class="tab-pane fade" id="drug" role="tabpanel" aria-labelledby="drug-tab">
                    @include('components.drugUsers.table')

                </div>






            </div>
        @endsection

        @push('scripts')
            {{-- @include('admin.users.js.view') --}}
        @endpush
