<div id="kt_app_sidebar" class="app-sidebar flex-column mt-lg-4 ps-2 pe-2 ps-lg-7 pe-lg-4" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <div class="app-sidebar-logo flex-shrink-0 d-none d-lg-flex flex-center align-items-center" id="kt_app_sidebar_logo">
        <a href="{{ url('/') }}">

            <img alt="Logo" src="{{ asset('storage/' . settings('general', 'logo')->value) }}" style="width: 100%"
                class="h-75px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{ asset('storage/' . settings('general', 'logo')->value) }}"
                class="h-40px theme-dark-show" style="width: 100%" />
        </a>
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>
        </div>
    </div>
    <div class="app-sidebar-menu flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="hover-scroll-overlay-y my-5" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <div class="menu menu-column menu-rounded menu-sub-indention fw-bold px-6" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">

                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.index') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-category fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.main') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                                href="{{ route('admin.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">{{ __('label.main') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                @if (auth('admin')->user()->can('view_admin') || auth('admin')->user()->can('view_role'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.admins.*') || request()->routeIs('admin.roles.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-setting fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.admin&role') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            @can('view_admin')


                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}"
                                        href="{{ route('admin.admins.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.admin_list') }}</span>
                                    </a>
                                </div>
                    @endif


                    @can('view_roles')
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                                href="{{ route('admin.roles.index') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">{{ __('label.role_list') }}</span>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
            @endif

            @if (auth('admin')->user()->can('view_branch'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.branches.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-hospital "></i>
                        </span>
                        <span class="menu-title">{{ __('label.branches') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_branch')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}"
                                    href="{{ route('admin.branches.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.branches') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_service'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.services.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-18  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.service_list') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_service')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                                    href="{{ route('admin.services.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.service_list') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_category'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.categories.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-49  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.categories_list') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_category')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.categories_list') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif
            @if (auth('admin')->user()->can('view_specialization'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.specializations.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-lungs "></i>
                        </span>
                        <span class="menu-title">{{ __('label.specializations') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_specialization')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.specializations.*') ? 'active' : '' }}"
                                    href="{{ route('admin.specializations.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.specializations') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif



            @if (auth('admin')->user()->can('view_banner'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.banners.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-circle "></i>
                        </span>
                        <span class="menu-title">{{ __('label.banners') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_banner')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}"
                                    href="{{ route('admin.banners.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.banners') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_doctor'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.doctors.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-41  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.doctors') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_doctor')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.doctors.*') ? 'active' : '' }}"
                                    href="{{ route('admin.doctors.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.doctors') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_medical_test'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.medicalTests.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-10  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.medical_test_types') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_medical_test')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.medicalTests.*') ? 'active' : '' }}"
                                    href="{{ route('admin.medicalTests.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.medical_test_types') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_medical_test'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.medicalTestUsers.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-15  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.medical_test') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_medical_test')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.medicalTestUsers.*') ? 'active' : '' }}"
                                    href="{{ route('admin.medicalTestUsers.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.medical_test') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_articale'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.articales.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-abstract-34  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.articales') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_articale')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.articales.*') ? 'active' : '' }}"
                                    href="{{ route('admin.articales.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.articales') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif

            @if (auth('admin')->user()->can('view_video'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.videos.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-youtube  fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.videos') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">

                        @can('view_video')
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}"
                                    href="{{ route('admin.videos.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.videos') }}</span>
                                </a>
                            </div>
                        @endcan

                    </div>
                </div>
            @endif




            @if (auth('admin')->user()->can('view_setting') || auth('admin')->user()->can('view_city'))
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs('admin.settings.*') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-setting fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.settings') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">


                        <div class="menu-item">
                            @can('view_setting')
                                <a class="menu-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.general_settings') }}</span>
                                </a>
                            @endcan
                            @can('view_city')
                                <a class="menu-link {{ request()->routeIs('admin.settings.cities.*') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.cities.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.cities') }}</span>
                                </a>
                            @endcan
                        </div>

                    </div>
                </div>
            @endif





        </div>
    </div>
    </div>



    <div class="app-sidebar-footer d-flex align-items-center px-8 pb-10" id="kt_app_sidebar_footer">
        <div class="">
            <div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
                <div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
                    <img src="{{ asset(auth('admin')->user()->getAttachment()) }}" alt="image" />
                </div>
                <div class="d-flex flex-column align-items-start justify-content-center ms-3">
                    <span class="text-gray-500 fs-8 fw-semibold">{{ __('label.welcome') }}</span>
                    <a href="{{ route('admin.profile.index') }}"
                        class="text-gray-800 fs-7 fw-bold text-hover-primary">{{ auth('admin')->user()->name }}</a>
                </div>
            </div>
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="{{ asset(auth('admin')->user()->getAttachment()) }}" />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{ auth('admin')->user()->name }}

                            </div>
                            <a href="{{ auth('admin')->user()->email }}"
                                class="fw-semibold text-muted text-hover-primary fs-7">{{ auth('admin')->user()->email }}</a>
                        </div>
                    </div>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a href="{{ route('admin.profile.index') }}" class="menu-link px-5">
                        <span class="menu-title position-relative">{{ __('label.profile') }}
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="ki-outline ki-user theme-light-show fs-2"></i>
                                <i class="ki-outline ki-user theme-dark-show fs-2"></i>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                    data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">Mode
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                                <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                            </span>
                        </span>
                    </a>


                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                        data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-night-day fs-2"></i></span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-moon fs-2"></i></span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-screen fs-2"></i></span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item px-5" data-kt-menu-trigger="click"
                    data-kt-menu-placement="bottom-end"
                    data-kt-menu-offset="0,10">
                    <a href="#" class="menu-link px-5">
                        <span class="menu-title position-relative">{{__('label.language')}}
                            <span
                                class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">

                                <img class="w-15px h-15px rounded-1 ms-2" src="assets/media/flags/united-states.svg"
                                    alt="" />
                            </span>
                        </span>
                    </a>

                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                        <div class="menu-item px-3">
                            <a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="menu-link d-flex px-5 active">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1" src="{{asset('assets/media/flags/united-states.svg')}}" alt="" />
                                </span>English
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="menu-link d-flex px-5">
                                <span class="symbol symbol-20px me-4">
                                    <img class="rounded-1" src="{{asset('assets/media/flags/palestine.svg')}}" alt="" />
                                </span>عربي
                            </a>
                        </div>
                        <!-- باقي العناصر -->
                    </div>
                </div>


                <div class="menu-item px-5">

                    <a href="{{ route('admin.logout') }}"
                        class="menu-link px-5 btn btn-active-light-danger w-100 text-start">
                        <span class="menu-title position-relative">{{ __('label.logout') }}
                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                <i class="ki-outline ki-exit-right theme-dark-show fs-2"></i>
                                <i class="ki-outline ki-exit-right theme-light-show fs-2"></i>
                            </span>
                        </span>
                    </a>

                </div>
            </div>
        </div>
    </div>
    </div>
