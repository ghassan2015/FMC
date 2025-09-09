<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../" />
    <title>{{ __('label.sign_in') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <link rel="shortcut icon" href="{{ asset('storage/' . settings('general', 'icon_logo')->value) }}" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap">
    <!-- Global Stylesheets Bundle -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Medical Theme -->
    <style>
        body {
            background-image: url("{{ asset('assets/media/auth/medical-bg.jpg') }}");
            background-size: cover;
            background-position: center;
            font-family: 'Cairo', sans-serif;
        }

        :root {
            --bs-primary: #28a745;
            /* اللون الأخضر الطبي */
        }

        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .text-primary {
            color: var(--bs-primary) !important;
        }

        .auth-box {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(5px);
            border-radius: 20px;
        }

        .form-control {
            border-radius: 8px;
        }
    </style>
    <script>
        // منع تحميل الصفحة داخل iframe
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>

<body>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        src="{{ asset('storage/' . settings('general', 'cover_logo')->value) }}" alt="Medical Logo" />

                </div>
            </div>
            <!--end::Aside-->

            <!--begin::Content-->
            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="auth-box d-flex flex-column flex-center w-md-600px p-10 shadow-lg">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <!--begin::Form-->
                            <form class="form w-100" novalidate="novalidate" id="login-form"
                                action="{{ route('admin.login.post') }}" method="POST">
                                @csrf
                                <!-- Logo -->
                                <div class="text-center mb-8">
                                    <img src="{{ asset('storage/' . settings('general', 'logo')->value) }}"
                                        style="max-height: 80px">
                                </div>
                                <!-- Title -->
                                <div class="text-center mb-8">
                                    <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                                    <h1 class="text-gray-900 fw-bolder mb-3">
                                        {{ __('label.sign_in_to_medical_dashboard') }}
                                    </h1>
                                </div>
                                <!-- Divider -->
                                <div class="separator separator-content my-10"></div>
                                <!-- Email -->
                                <div class="fv-row mb-8">
                                    <input type="text" placeholder="{{ __('label.email') }}" name="email"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Password -->
                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="{{ __('label.password') }}" name="password"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Forgot password link -->
                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>
                                    <a href="" class="link-primary">
                                        {{ __('label.forgot_password') }}
                                    </a>
                                </div>
                                <!-- Submit button -->
                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                        <span class="indicator-label">{{ __('label.sign_in') }}</span>
                                        <span class="indicator-progress">{{ __('label.please_wait') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--begin::Language switch-->
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
                        <!--end::Language switch-->
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
    </div>
    <!-- Scripts -->
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#login-form').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "البريد الإلكتروني مطلوب",
                        email: "الرجاء إدخال بريد إلكتروني صالح"
                    },
                    password: {
                        required: "كلمة المرور مطلوبة",
                        minlength: "كلمة المرور يجب أن تكون 6 أحرف على الأقل"
                    }
                },
                submitHandler: function(form) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message, 'تم تسجيل الدخول');
                                window.location.href = response.redirect;
                            } else {
                                toastr.error(response.message, 'خطأ');
                            }
                        },
                        error: function(xhr) {
                            let message = xhr.responseJSON?.message || 'حدث خطأ غير متوقع';
                            toastr.error(message, 'خطأ');
                        }
                    });
                }
            });
        });
    </script>
</body>
<!--end::Body-->

</html>
