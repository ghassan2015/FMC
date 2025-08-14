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
                    class="menu-item {{ request()->routeIs('admin.home') ? 'here show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-category fs-2"></i>
                        </span>
                        <span class="menu-title">{{ __('label.main') }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.home') ? 'active' : '' }}"
                                href="{{ route('admin.home') }}">
                                <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                <span class="menu-title">{{ __('label.main') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                @if (auth('admin')->user()->can('view_admin') || auth('admin')->user()->can('view_roles'))
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


                            @if (auth('admin')->user()->can('view_admin'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}"
                                        href="{{ route('admin.admins.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.admin_list') }}</span>
                                    </a>
                                </div>
                            @endif
                            @if (auth('admin')->user()->can('view_roles'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                                        href="{{ route('admin.roles.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.role_list') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif

                @if (auth('admin')->user()->can('view_branch'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.branches.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-42 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.branches') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_branch'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}"
                                        href="{{ route('admin.branches.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.branch_list') }}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                @endif
                @if (auth('admin')->user()->can('view_users'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.users.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-user fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.users') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_users'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.users.index') && !request()->has('status') ? 'active' : '' }}"
                                        href="{{ route('admin.users.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.users_list') }}</span>
                                    </a>
                                </div>
                            @endif



                            @if (auth('admin')->user()->can('view_users'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->get('status') == 'inside-hub' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', ['status' => 'inside-hub']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.users_inside_hub_list') }}</span>
                                    </a>
                                </div>
                            @endif


                            @if (auth('admin')->user()->can('view_users'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->get('status') == 'non-hub' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', ['status' => 'non-hub']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.users_non_hub_list') }}</span>
                                    </a>
                                </div>
                            @endif


                            @if (auth('admin')->user()->can('view_users'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->get('status') == 'non-active' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', ['status' => 'non-active']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.users_non_active_hub_list') }}</span>
                                    </a>
                                </div>
                            @endif

                            @if (auth('admin')->user()->can('verification_users'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->get('status') == 'under-verification' ? 'active' : '' }}"
                                        href="{{ route('admin.users.index', ['status' => 'under-verification']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.users_under_verification_list') }}</span>
                                    </a>
                                </div>
                            @endif

                            @if (auth('admin')->user()->can('under_examination_users'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->routeIs('admin.users.veririfcation') ? 'active' : '' }} "
                                        href="{{ route('admin.users.veririfcation') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.users_verification_list') }}</span>
                                    </a>
                                </div>
                            @endif


                            @if (auth('admin')->user()->can('join_branch'))
                                <div class="menu-item">
                                    <a class="menu-link  {{ request()->routeIs('admin.users.joinBranches') ? 'active' : '' }} "
                                        href="{{ route('admin.users.joinBranches') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.join_branch_list') }}</span>
                                    </a>
                                </div>
                            @endif


                        </div>
                    </div>

                @endif


                @if (auth('admin')->user()->can('view_subscription_type') ||
                        auth('admin')->user()->can('view_internet_subscription') ||
                        auth('admin')->user()->can('view_ready_internet_subscription') ||
                        auth('admin')->user()->can('view_pendding_internet_subscription') ||
                        auth('admin')->user()->can('view_available_internet_subscription') ||
                        auth('admin')->user()->can('view_expired_internet_subscription') ||
                        auth('admin')->user()->can('view_delete_internet_subscription'))
                    @php
                        $internetRoutes = [
                            'admin.internetSubscriptions.index',
                            'admin.internetSubscriptions.*',
                            'admin.subscriptionTypes.*',
                        ];
                        $anyInternetActive = request()->routeIs(...$internetRoutes);
                    @endphp

                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ $anyInternetActive ? 'here show' : '' }} menu-accordion">

                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-loading fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.internet_subscription') }}</span>
                            <span class="menu-arrow"></span>
                        </span>

                        <div class="menu-sub menu-sub-accordion">
                            @can('view_subscription_type')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.subscriptionTypes.*') ? 'active' : '' }}"
                                        href="{{ route('admin.subscriptionTypes.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.subscription_type_list') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index')) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.internet_subscrption_list') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view_ready_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index', ['status' => 'active'])) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index', ['status' => 'active']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.active_internet_subscription_list') }}</span>
                                    </a>
                                </div>
                            @endcan

                            @can('view_pendding_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index', ['status' => 'pending'])) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index', ['status' => 'pending']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.pendding_internet_subscription_list') }}</span>
                                    </a>
                                </div>
                            @endcan
                            @can('view_available_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index', ['status' => 'available'])) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index', ['status' => 'available']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.available_internet_subscription_list') }}</span>
                                    </a>
                                </div>
                            @endcan

                            @can('view_expired_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index', ['status' => 'expired'])) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index', ['status' => 'expired']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.expired_internet_subscription_list') }}</span>
                                    </a>
                                </div>
                            @endcan

                            @can('view_delete_internet_subscription')
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->fullUrlIs(route('admin.internetSubscriptions.index', ['status' => 'deleted'])) ? 'active' : '' }}"
                                        href="{{ route('admin.internetSubscriptions.index', ['status' => 'expired']) }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span
                                            class="menu-title">{{ __('label.deleted_internet_subscription_list') }}</span>
                                    </a>
                                </div>
                            @endcan


                        </div>
                    </div>
                @endif
                @if (auth('admin')->user()->can('view_withdraws'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.workSpaceManagments.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-46	 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.work_space_mangnement') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_service'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.workSpaceManagments.services.*') ? 'active' : '' }}"
                                        href="{{ route('admin.workSpaceManagments.services.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.services_list') }}</span>
                                    </a>
                                </div>
                            @endif



                            @if (auth('admin')->user()->can('view_work_space'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.workSpaceManagments.workSpaces.*') ? 'active' : '' }}"
                                        href="{{ route('admin.workSpaceManagments.workSpaces.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.work_space_list') }}</span>
                                    </a>
                                </div>
                            @endif

                            @if (auth('admin')->user()->can('view_desk_mangment'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.workSpaceManagments.deskManagments.*') ? 'active' : '' }}"
                                        href="{{ route('admin.workSpaceManagments.deskManagments.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.desk_mangments_list') }}</span>
                                    </a>
                                </div>
                            @endif


                            @if (auth('admin')->user()->can('view_room_mangment'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.workSpaceManagments.rooms.*') ? 'active' : '' }}"
                                        href="{{ route('admin.workSpaceManagments.rooms.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.room_mangments_list') }}</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                @endif



                @if (auth('admin')->user()->can('view_branch'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.invoices.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-47 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.invoices') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_branch'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}"
                                        href="{{ route('admin.invoices.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.invoice_list') }}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                @endif



                @if (auth('admin')->user()->can('view_job_constrancts'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.jobConstrancts.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-36 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.job_constrancts') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_job_constrancts'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.jobConstrancts.*') ? 'active' : '' }}"
                                        href="{{ route('admin.jobConstrancts.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.job_constranct_list') }}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                @endif


                @if (auth('admin')->user()->can('view_income_movements'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.incomeMovements.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-35 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.income_movement') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_income_movements'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.incomeMovements.*') ? 'active' : '' }}"
                                        href="{{ route('admin.incomeMovements.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.income_movement_list') }}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                @endif







                @if (auth('admin')->user()->can('view_restaurant') ||
                        auth('admin')->user()->can('view_product') ||
                        auth('admin')->user()->can('view_category') ||
                        auth('admin')->user()->can('view_order'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.restaurants.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-43 fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.restaurant_mangment') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_restaurant'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.restaurants.index') ? 'active' : '' }}"
                                        href="{{ route('admin.restaurants.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.restaurant_list') }}</span>
                                    </a>
                                </div>
                            @endif

                            @if (auth('admin')->user()->can('view_category'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.restaurants.categories.*') ? 'active' : '' }}"
                                        href="{{ route('admin.restaurants.categories.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.categories_list') }}</span>
                                    </a>
                                </div>
                            @endif
                            @if (auth('admin')->user()->can('view_product'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.restaurants.products.*') ? 'active' : '' }}"
                                        href="{{ route('admin.restaurants.products.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.product_list') }}</span>
                                    </a>
                                </div>
                            @endif


                            @if (auth('admin')->user()->can('view_order'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.restaurants.orders.*') ? 'active' : '' }}"
                                        href="{{ route('admin.restaurants.orders.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.order_list') }}</span>
                                    </a>
                                </div>
                            @endif



                        </div>
                    </div>

                @endif




    @if (auth('admin')->user()->can('view_wallet')|| auth('admin')->user()->can('view_wallet_movements'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.wallets.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-40  fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.wallet_mangment') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_setting'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.wallets.index') ? 'active' : '' }}"
                                        href="{{ route('admin.wallets.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.wallets') }}</span>
                                    </a>
                                </div>
                            @endif

                              @if (auth('admin')->user()->can('view_setting'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.wallets.walletRecipt') ? 'active' : '' }}"
                                        href="{{ route('admin.wallets.walletRecipt') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.wallet_recipt') }}</span>
                                    </a>
                                </div>
                            @endif


                        </div>
                    </div>

                @endif


                @if (auth('admin')->user()->can('view_logs'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.reports.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-45  fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.reports') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                                    href="{{ route('admin.reports.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.report_list') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                @endif


                @if (auth('admin')->user()->can('view_logs'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.logs.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-time  fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.logs') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}"
                                    href="{{ route('admin.logs.index') }}">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">{{ __('label.log_list') }}</span>
                                </a>
                            </div>

                        </div>
                    </div>
                @endif

                @if (auth('admin')->user()->can('view_activities'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.activities.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-44  fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.activities') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_activities'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}"
                                        href="{{ route('admin.activities.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.activities_list') }}</span>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                @endif

                @if (auth('admin')->user()->can('view_setting'))
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ request()->routeIs('admin.settings.*') ? 'here show' : '' }} menu-accordion">
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-abstract-40  fs-2"></i>
                            </span>
                            <span class="menu-title">{{ __('label.setting_list') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">


                            @if (auth('admin')->user()->can('view_setting'))
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}"
                                        href="{{ route('admin.settings.index') }}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">{{ __('label.setting_list') }}</span>
                                    </a>
                                </div>
                            @endif

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
                                {{-- @forelse(auth('admin')->user()->roles as $role)
                                    <span
                                        class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-1">{{ $role->display_name }}</span>
                                @empty
                                    <span class="text-muted fs-8">No roles assigned</span>
                                @endforelse --}}
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
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-night-day fs-2"></i></span>
                                <span class="menu-title">Light</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-moon fs-2"></i></span>
                                <span class="menu-title">Dark</span>
                            </a>
                        </div>
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon"><i
                                        class="ki-outline ki-screen fs-2"></i></span>
                                <span class="menu-title">System</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="menu-item px-5">

                        <a  href="{{route('admin.logout')}}" class="menu-link px-5 btn btn-active-light-danger w-100 text-start">
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
