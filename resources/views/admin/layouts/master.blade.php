<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.3.0
Purchase: https://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?irgwc=1&clickid=Qb1XFm3dIxyIUCez3ZXf1X0mUks0kb3cC2sEUQ0&iradid=275988&irpid=1330466&iradtype=ONLINE_TRACKING_LINK&irmptype=mediapartner&mp_value1=&utm_campaign=af_impact_radius_1330466&utm_medium=affiliate&utm_source=impact_radius
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="ar" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<!--begin::Head-->

<head>
    <title>Taqat - @yield('title')</title>

    @include('admin.layouts.css')
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true"
    class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->


    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->

            @include('admin.layouts.header')
            <!--end::Header-->

            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->

                @include('admin.layouts.sidebar')
                <!--end::Sidebar-->

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">


                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">


                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-fluid">

                                @include('admin.layouts.breadcrumbs')

                                <!--begin::Row-->

                                <div class="row">

                                    @yield('content')
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->



                    <!--begin::Footer-->
                    @include('admin.layouts.footer')
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->





    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->
    @include('Shared.delete')

    
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    //
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script>
        $(".kt_datepicker").flatpickr({
            allowInput: true,
            dateFormat: "Y-m-d",
            onReady: function(selectedDates, dateStr, instance) {
                const clearButton = document.createElement("button");
                clearButton.textContent = "Clear";
                clearButton.type = "button";
                clearButton.classList.add("flatpickr-clear-button");
                clearButton.addEventListener("click", function() {
                    instance.clear();
                });

                instance.calendarContainer.appendChild(clearButton);
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('[data-kt-menu-trigger]').forEach(el => {
                new KTMenu(el); // ✅ هذا هو الصحيح
            });
        });
    </script>
    @include('admin.layouts.scripts')
    @stack('scripts')

</body>
<!--end::Body-->

</html>
