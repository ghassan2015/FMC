<!-- Mirrored from html.vecurosoft.com/medixi/demo/index-8.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 28 Aug 2025 13:05:26 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{settings('general','name')->value}} @yield('title')</title>
    <meta name="author" content="Vecuro">
    <meta name="description" content="{{settings('general','description')->value}}">
    <meta name="keywords" content="{{settings('general','description')->value}}">
    <meta name="robots" content="INDEX,FOLLOW">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--==============================
 Google Web Fonts
 ============================== -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&amp;family=Quicksand:wght@400;700&amp;family=Roboto:wght@400;500;700&amp;display=swap"
        rel="stylesheet">


    <!-- Favicons - Place favicon.ico in the root directory -->
    <link rel="shortcut icon" href="{{asset('storage/'.settings('general','icon_logo')->value)}}" type="image/x-icon">
    <link rel="icon" href="{{asset('storage/'.settings('general','icon_logo')->value)}}" type="image/x-icon">


    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/app.min.css"> -->
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">

    <!-- Layerslider -->
    <link rel="stylesheet" href="{{ asset('assets/css/layerslider.min.css') }}">


    <!-- jQuery DatePicker -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.datetimepicker.min.css') }}">


    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.min.css') }}">

    <!-- Slick Slider -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.min.css') }}">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:wght@200..1000&family=Gulzar&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Noto+Kufi+Arabic:wght@100..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Cairo', sans-serif !important;
            }
        </style>
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @endif

    <!-- Theme Custom CSS -->

    <style>
        .error{
            color: red
        }
        </style>

</head>
