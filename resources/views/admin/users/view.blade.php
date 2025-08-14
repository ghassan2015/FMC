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
                        <img src="{{ $user->getPhoto() }}" alt="image" />
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
                                    <i
                                        class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ $user->specialization?->title }}</a>
                                <a href="#"
                                    class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                    <i class="ki-outline ki-geolocation fs-4 me-1"></i>{{ $user->displacement_place }}</a>
                                <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
                                    <i class="ki-outline ki-sms fs-4"></i>{{ $user->email }}</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                        <!--begin::Actions-->
                        <div class="d-flex my-4">

                            <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_offer_a_deal">نظرة عامة على منصة طاقات</a>
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
                                    @if (auth('admin')->user()->can('edit_users') && request('status') !== 'delete-hub')
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-user-edit text-warning"></i>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="menu-link px-2">
                                                {{ __('label.edit_user') }}
                                            </a>
                                        </div>
                                    @endif

                                    {{-- عرض الفواتير --}}

                                    {{-- إضافة فاتورة --}}
                                    @if (
                                        (auth('admin')->user()->can('add_invoce') && $user->status == 1 && $user->userRooms->isEmpty()) ||
                                            $user->rooms()->count() > 0)
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-file-invoice text-success"></i>
                                            <a href="#" class="menu-link px-2 add_invoice"
                                                data-user_id="{{ $user->id }}">
                                                {{ __('label.add_invoice') }}
                                            </a>
                                        </div>
                                    @endif


                                    <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                        <i class="fas fa-sms text-dark"></i>

                                        <a href="#" class="menu-link px-2 sendSms"
                                            data-user_id="{{ $user->id }}">
                                            {{ __('label.send_sms') }}
                                        </a>
                                    </div>
                                    {{-- اشتراك الإنترنت --}}
                                    @if (auth('admin')->user()->can('view_internet_subscription') &&
                                            $user->status == 1 &&
                                            request('status') !== 'delete-hub')
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-wifi text-primary"></i>
                                            <a href="#" class="menu-link px-2 internet_subscription"
                                                data-user_id="{{ $user->id }}"
                                                data-desk_mangment_id="{{ $user->id }}">
                                                {{ __('label.internet_subscription') }}
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

                                    {{-- تحقق المستخدم --}}
                                    @if (auth('admin')->user()->can('verification_users'))
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-user-check text-success"></i>
                                            <a href="#" class="menu-link px-2 verification_user"
                                                data-user_id="{{ $user->id }}">
                                                {{ __('label.user_verification') }}
                                            </a>
                                        </div>
                                    @endif

                                    {{-- تغيير حالة المستخدم أو نقله لفرع --}}
                                    @if (auth('admin')->user()->can('add_To_branch') && request('status') !== 'delete-hub')
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1">
                                            <i class="fas fa-exchange-alt text-info"></i>
                                            <a href="#" class="menu-link px-2 add_user"
                                                data-user_id="{{ $user->id }}" data-branch_id="{{ $user->branch_id }}"
                                                data-status="{{ $user->status }}"
                                                data-work_space_id="{{ $user->work_space_id }}"
                                                data-desk_mangment_id="{{ $user->desk_mangment_id }}"
                                                data-user_type_cd_id="{{ $user->user_type_cd_id }}">
                                                {{ __('label.status_user') }}
                                            </a>
                                        </div>
                                    @endif

                                    {{-- تحرير المكتب --}}
                                    @if (auth('admin')->user()->can('release_desk_mangment') && $user->deskMangment)
                                        <div class="menu-item d-flex align-items-center gap-2 px-3 mb-1 release_block">
                                            <i class="fas fa-door-open text-success"></i>
                                            <a href="#" class="menu-link px-2 release"
                                                data-id="{{ $user->deskMangment->id }}"
                                                data-code="{{ $user->deskMangment->code }}">
                                                {{ __('label.release_desk_mangment') }}
                                            </a>
                                        </div>
                                    @endif


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
                                            data-kt-countup-value="{{ $user->totalIncome() }}" data-kt-countup-prefix="$">0
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.total_income') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-down fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                            data-kt-countup-value="{{ $user->totalContracts() }}">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.total_contracts') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-arrow-up fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true"
                                            data-kt-countup-value="{{ $user->countProjects() }}">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-500">{{ __('label.project_count') }}</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-500">{{ __('label.profile_Compleation') }}</span>
                                <span class="fw-bold fs-6">{{ $user->calculateProfileScore() }}%</span>
                            </div>
                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar"
                                    style="width: {{ $user->calculateProfileScore() }}%;"
                                    aria-valuenow="{{ $user->calculateProfileScore() }}" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
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
                @if (auth('admin')->user()->can('view_invoice'))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice"
                            type="button" role="tab" aria-controls="invoice" aria-selected="false">
                            {{ __('label.invoice_list') }}
                        </button>
                    </li>
                @endif
                @if (auth('admin')->user()->can('view_job_constrancts'))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="job_constract-tab" data-bs-toggle="tab"
                            data-bs-target="#job_constract" type="button" role="tab" aria-controls="job_constract"
                            aria-selected="false">
                            {{ __('label.job_constranct_list') }}
                        </button>
                    </li>
                @endif

                @if (auth('admin')->user()->can('view_income_movements'))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="income_movement-tab" data-bs-toggle="tab"
                            data-bs-target="#income_movement" type="button" role="tab"
                            aria-controls="income_movement" aria-selected="false">
                            {{ __('label.income_movement_list') }}
                        </button>
                    </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="training_courses-tab" data-bs-toggle="tab"
                        data-bs-target="#training_courses" type="button" role="tab"
                        aria-controls="training_courses" aria-selected="false">
                        {{ __('label.training_course_list') }}
                    </button>
                </li>
                                @if(auth('admin')->user()->can('view_projects'))

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="projects-tab" data-bs-toggle="tab" data-bs-target="#projects"
                        type="button" role="tab" aria-controls="projects" aria-selected="false">
                        {{ __('label.project_list') }}
                    </button>
                </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="apikeys-tab" data-bs-toggle="tab" data-bs-target="#apikeys"
                        type="button" role="tab" aria-controls="apikeys" aria-selected="false">
                        الخبرات العملية
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="logs-tab" data-bs-toggle="tab" data-bs-target="#logs" type="button"
                        role="tab" aria-controls="logs" aria-selected="false">
                        {{ __('label.log_list') }}
                    </button>
                </li>


            </ul>
            <div class="tab-content" id="profileTabContent">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <!-- Overview Content -->
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">{{ __('label.my_profile') }}</h3>
                            </div>
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="btn btn-sm btn-primary align-self-center">{{ __('label.edit_user') }}</a>
                        </div>
                        <div class="card-body p-9">
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.name') }}</label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->full_name ?? $user->name }}</span>
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
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.whatsapp') }}</label>
                                <div class="col-lg-8 d-flex align-items-center">
                                    <i class="ki-outline ki-whatsapp fs-2 text-success me-2"></i>
                                    <a href="https://wa.me/{{ $user->whatsapp }}" target="_blank"
                                        class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $user->whatsapp }}</a>
                                </div>
                            </div>
                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.displacement_place') }}
                                    <span class="ms-1" data-bs-toggle="tooltip" title="">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $user->displacement_place }}</span>
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
                                </div </div>
                            </div>

                            <div class="row mb-7">
                                <label class="col-lg-4 fw-semibold text-muted">{{ __('label.id_photo') }}</label>
                                <div class="col-lg-8">
                                    @if ($user->id_photo)
                                        <img src="{{ $user->getIdPhoto() }}" alt="ID Photo" class="img-fluid rounded"
                                            style="max-width: 200px;">
                                    @else
                                        <span class="fw-bold fs-6 text-gray-800">{{ __('No ID photo available') }}</span>
                                    @endif
                                </div </div>
                            </div>
                        </div>
                    </div>

                </div>
                @if (auth('admin')->user()->can('view_invoice'))
                    <!-- You can add content for other tabs below -->
                    <div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">



                        @include('components.invoice.table')



                    </div>
                @endif
                <!-- Settings Content -->

                @if (auth('admin')->user()->can('view_job_constrancts'))
                    <div class="tab-pane fade" id="job_constract" role="tabpanel" aria-labelledby="job_constract-tab">
                        <!-- Security Content -->

                        @include('components.jobConstrancts.table')
                    </div>
                @endif
                @if (auth('admin')->user()->can('view_income_movements'))
                    <div class="tab-pane fade" id="income_movement" role="tabpanel"
                        aria-labelledby="income_movement-tab">


                        @include('components.incomeMovements.table')
                    </div>
                @endif


                <div class="tab-pane fade" id="training_courses" role="tabpanel" aria-labelledby="training_courses-tab">

                    @include('components.courseTranings.table')
                </div>
                @if(auth('admin')->user()->can('view_projects'))
                <div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">

                    @include('components.projects.table')
                </div>
                @endif
                @if (auth('admin')->user()->can('view_logs'))
                    <div class="tab-pane fade" id="logs" role="tabpanel" aria-labelledby="logs-tab">
                        @include('components.logs.table')
                    </div>
                @endif
                <div class="tab-pane fade" id="apikeys" role="tabpanel" aria-labelledby="apikeys-tab">

                    @include('components.workExperiences.table')
                </div>

            </div>

            @include('components.invoice.add_edit_invoice')

            @include('components.internetSubscriptions.add_edit')
            @include('components.notifications.notification')
            @include('components.notifications.sms_notification')

            @include('admin.users.modal.user_details')



            @include('admin.users.modal.add')

            @include('admin.workSpaceMangements.deskMangments.modal.release')
        @endsection

        @push('scripts')
            @include('admin.users.js.view')
        @endpush
