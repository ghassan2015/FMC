<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>{{ __('label.sign_in') }}</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Tailwind CSS & Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="tailwind, tailwindcss, metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - The World's #1 Selling Tailwind CSS & Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="http://preview.keenthemes.comauthentication/layouts/overlay/sign-in.html" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <style>
        body {
            background-image: url("{{ asset('assets/media/auth/bg10.jpeg') }}");
        }

        [data-bs-theme="dark"] body {
            background-image: url('{{ asset('assets/media/auth/bg10-dark.jpeg') }}');
        }
    </style>

    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="{{ asset('assets/media/auth/agency.png') }}" alt="" />
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                    src="{{ asset('assets/media/auth/agency-dark.png') }}" alt="" />

                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">{{ __('label.fast_efficient_productive') }}
                </h1>

                <div class="text-gray-600 fs-base text-center fw-semibold">
                    {{ __('label.intro_description') }}
                    <a href="#" class="opacity-75-hover text-primary me-1">{{ __('label.blogger') }}</a>
                    {{ __('label.introduces_interviewee') }}<br />
                    <a href="#" class="opacity-75-hover text-primary me-1">{{ __('label.interviewee') }}</a>
                    {{ __('label.and_work_following') }}
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                            action="{{ route('admin.login.post') }}" method="POST">
                            @csrf

                            <div class="text-center mb-11">
                                <img src="{{ asset('assets/logo.svg') }}"style="width: 100%">
                            </div>
                            <div class="text-center mb-11">
                                <h1 class="text-gray-900 fw-bolder mb-3">{{ __('label.sign_in') }}</h1>
                            </div>

                            <div class="separator separator-content my-14"></div>

                            <div class="fv-row mb-8">
                                <input type="text" placeholder="{{ __('label.email') }}" name="email"
                                    autocomplete="off" class="form-control bg-transparent" />
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="fv-row mb-3">
                                <input type="password" placeholder="{{ __('label.password') }}" name="password"
                                    autocomplete="off" class="form-control bg-transparent" />
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="" class="link-primary">
                                    {{ __('label.forgot_password') }}
                                </a>
                            </div>

                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    <span class="indicator-label">{{ __('label.sign_in') }}</span>
                                    <span class="indicator-progress">{{ __('label.please_wait') }}
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>


                        </form>
                    </div>

                    <div class="d-flex flex-stack">
                        <div class="me-10">
                            <button
                                class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                                    src="{{ asset('assets/media/flags/united-states.svg') }}" alt="" />
                                <span data-kt-element="current-lang-name"
                                    class="me-1">{{ __('label.language') }}</span>
                                <i class="ki-outline ki-down fs-5 text-muted rotate-180 m-0"></i>
                            </button>

                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px py-4 fs-7"
                                data-kt-menu="true" id="kt_auth_lang_menu">
                                <div class="menu-item px-3">
                                    <a href="" class="menu-link d-flex px-5">
                                        <span class="symbol symbol-20px me-4">
                                            <img src="{{ asset('assets/media/flags/united-states.svg') }}"
                                                class="rounded-1" alt="" />
                                        </span>
                                        <span>{{ __('label.english') }}</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="" class="menu-link d-flex px-5">
                                        <span class="symbol symbol-20px me-4">
                                            <img src="{{ asset('assets/media/flags/palestine.svg') }}"
                                                class="rounded-1" alt="" />
                                        </span>
                                        <span>{{ __('label.arabic') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var hostUrl = "assets/";
</script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
{{-- <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script> --}}
<!--end::Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
