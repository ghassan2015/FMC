@extends('admin.layouts.master')
@section('title', __('label.edit_admin'))
@section('toolbarSubTitle', __('label.admins_list'))
@section('toolbarPage', __('label.edit_admin'))

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
									<!--begin::Contact-->
									<div class="card">
										<!--begin::Body-->
										<div class="card-body p-lg-17">
            <form id="my-form" method="POST" enctype="multipart/form-data" action="{{ route('admin.admins.update') }}">
                @csrf

                <input type="hidden" name="admin_id" value="{{ $admin->id }}">

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label required">{{ __('label.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                        <div class="text-danger name_error" style="display: none"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">{{ __('label.email') }}</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                        <div class="text-danger email_error" style="display: none"></div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label class="form-label required">{{ __('label.mobile') }}</label>
                        <input type="text" name="mobile" class="form-control"
                            value="{{ old('mobile', $admin->mobile) }}">
                        <div class="text-danger phone_error" style="display: none"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label required">{{ __('label.password') }}</label>
                        <input type="password" name="password" class="form-control">
                        <div class="text-danger password_error" style="display: none"></div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-4">
                        <label class="form-label required">{{ __('label.branches') }}</label>
                        <select class="form-select form-select-solid" data-control="select2"
                           @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif
                        name="branch_id"
                            data-control="select2">
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}"
                                    {{ old('branch_id', $admin->branch_id) == $value->id ? 'selected' : '' }}>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger branch_error" style="display: none"></div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">{{ __('label.roles') }}</label>
                        <select class="form-select form-select-solid" data-control="select2" name="role_id"
                            @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif
                            data-control="select2">
                            <option value="">{{ __('label.selected') }}</option>
                            @foreach ($roles as $value)
                                <option value="{{ $value->id }}"
                                    {{ old('role_id', $admin->role_id) == $value->id ? 'selected' : '' }}>
                                    {{ $value->name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger role_id_error" style="display: none"></div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label required">{{ __('label.redirect_route') }}</label>
                        <select class="form-select form-select-solid" data-control="select2"
                           @if(app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif
                        name="redirect_route"
                            data-control="select2">
                            @php
                                $routes = [
                                    'home' => 'لوحة التحكم',
                                    'users.index' => 'قائمة المستخدمين',
                                    'users.veririfcation' => 'قائمة المستخدمين قيد الفحص',
                                    'branches.index' => 'قائمة الفروع',
                                    'roles.index' => 'قائمة الصلاحيات',
                                    'companies.index' => 'قائمة الشركات',
                                    'expenses.index' => 'قائمة المصاريف التشغيلية',
                                    'wallet_movements.index' => 'بيانات حركات المحفظة',
                                    'agreements.index' => 'قائمة اتفاقية الاستخدام',
                                    'projects.index' => 'قائمة المشاريع',
                                    'jobs.index' => 'قائمة الوظائف',
                                    'attendances.index' => 'قائمة الحضور والانصراف',
                                    'chats.index' => 'مقابلات الدردشات',
                                    'reports.attendances' => 'تقرير الحضور',
                                    'reports.user_attendances' => 'تقرير الحضور حسب المستخدم',
                                    'logs.index' => 'سجل الحضور والانصراف',
                                    'user_branches.index' => 'طلبات التحاق بالفروع',
                                    'invoices.index' => 'فواتير',
                                    'reports.index' => 'تقارير',
                                    'subscription_types.index' => 'اشتراكات نوع',
                                    'internet_subscriptions.index' => 'اشتراكات الانترنت',
                                    'work_spaces.index' => 'مساحات العمل',
                                    'services.index' => 'الخدمات',
                                    'desk_managements.index' => 'ادارة المكاتب',
                                    'room_managements.index' => 'ادارة الغرفة',
                                    'tree.index' => 'ادارة الحسابات -الشجرة',
                                    'account_users.index' => 'ادارة الحسابات-المستخدمين',
                                    'tranactions_report.index' => 'تقرير المعاملات المحاسبية',
                                    'assets.index' => 'ادارة الحسابات-الاصول',
                                    'equities.index' => 'ادارة الحسابات-حقوق الملكية',
                                    'liabilities.index' => 'التزامات-ادارة الحسابات',
                                    'account_expenses.index' => 'المصاريف-ادارة الحسابات',
                                    'interviews.index' => 'مقابلات العمل',
                                    'withdraws.index' => 'طلبات السحب',
                                    'activities.index' => 'عرض الانشطة مدراء النظام',
                                    'generator_subscriptions.index' => 'ادارة اشتراكات المولد',
                                    'generators.index' => 'قائمة المولدات',
                                    'generator_readings.index' => 'قراءات اشتراكات المولد',
                                    'generator_receipts.index' => 'سندات القبض',
                                    'restaurants.index' => 'ادارة مطاعم',
                                    'categories.index' => 'تصنيفات المنتجات-ادارة مطاعم',
                                    'products.index' => 'منتجات-ادارة مطاعم',
                                    'orders.index' => 'ادارة الطلبات-ادارة مطاعم',
                                ];
                            @endphp
                            @foreach ($routes as $route => $name)
                                <option value="{{ $route }}"
                                    {{ old('redirect_route', $admin->redirect_route) == $route ? 'selected' : '' }}>
                                    {{ $name }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger redirect_route_error" style="display: none"></div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-md-6">
                        <label for="image" class="form-label required d-block mb-2">{{ __('label.photo') }}</label>

                        <div class="image-input image-input-empty" data-kt-image-input="true">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"
                                style="background-image: url('{{ $admin->getAttachment() }}'); background-size: cover;">
                            </div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                <i class="ki-duotone ki-pencil fs-6"></i>
                                <input type="file" name="image" id="image"
                                    accept=".png, .jpg, .jpeg, .gif, .bmp, .webp" />
                                <input type="hidden" name="avatar_remove" />
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                    </div>


                    <div class="row mb-5">
                        <label for="image" class="form-label required d-block mb-2">{{ __('label.status') }}</label>

                        <div class="col-md-6 d-flex align-items-center mb-2 ">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status"
                                    value="1" checked>
                            </div>
                        </div>
                    </div>

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
@section('scripts')
    <script>
        var imageInputElement = document.querySelector('[data-kt-image-input="true"]');
        if (imageInputElement) {
            new KTImageInput(imageInputElement);
        }
    </script>
@endsection
