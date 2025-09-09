@extends('front.layouts.master')

@section('content')
    <div class="breadcumb-wrapper ">
        <div class="parallax" data-parallax-image="{{ asset('assets/img/breadcurmb/breadcurmb-1-1.jpg') }}"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title"></h1>
                <div class="breadcumb-menu-wrap">
                    <i class="far fa-home-lg"></i>
                    <ul class="breadcumb-menu">
                        <li><a href="index.html">{{ __('label.main') }}</a></li>
                        <li class="active">{{ __('label.about_us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                About Area
                ==============================-->
    <section class="vs-about-wrapper space">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-6 mb-40 mb-lg-0">
                    <div class="vs-surface wow" data-wow-delay="0.3s">
                        <div class="about-img3 position-relative">
                            <img src="{{ asset('assets/img/about/about-4-1.jpg') }}" alt="About Image" class="w-100">
                            <a href="https://www.youtube.com/watch?v=_sI_Ps7JSEk"
                                class="popup-video play-btn style2 position-center"><i class="fas fa-play"></i></a>
                            <div class="exp-box-bottom bg-white">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="about-content mb-2">
                        <!-- العنوان الفرعي -->
                        <span class="sec-subtitle text-theme h3 mb-2 mb-md-0">
                            {{ __('label.subtitle_about_us') }}
                        </span>

                        <div class="row">
                            <!-- العنوان الرئيسي -->
                            <div class="col-xl-10">
                                <h2 class="h1 mb-3">
                                    {{ __('label.title_about_us') }}
                                    <span class="text-theme">{{ settings('general', 'name')->value }}</span>.
                                </h2>
                            </div>

                            <!-- الوصف -->
                            <div class="col-xl-10">
                                <p class="mb-4">
                                    {{ __('label.description_about_us', ['name' => settings('general', 'name')->value]) }}
                                </p>
                            </div>
                        </div>

                        <!-- جزء الاتصال -->
                        <div class="contact-info">

                            <!-- الهاتف -->
                    <div class="media-style1 mb-3">
                                <div class="media-icon"><i class="fas fa-phone text-danger"></i></div>
                                <div class="media-body">
                                    <h3 class="media-title">{{ __('label.mobile') }}</h3>
                                    <p class="media-text">
                                        <a href="">
                                            {{ settings('contact_us', 'mobile')->value }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <!-- الواتساب -->
                            <div class="media-style1 mb-3">
                                <div class="media-icon"><i class="fab fa-whatsapp text-success"></i></div>
                                <div class="media-body">
                                    <h3 class="media-title">{{ __('label.whatsapp') }}</h3>
                                    <p class="media-text">
                                        <a target="_blank"
                                            href="https://wa.me/{{ settings('contact_us', 'whatsapp')->value }}">
                                            {{ settings('contact_us', 'whatsapp')->value }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <!-- الإيميل -->
                            <div class="media-style1">
                                <div class="media-icon"><i class="fas fa-envelope text-primary"></i></div>
                                <div class="media-body">
                                    <h3 class="media-title">{{ __('label.email') }}</h3>
                                    <p class="media-text">
                                        <a href="mailto:{{ settings('contact_us', 'email')->value }}">
                                            {{ settings('contact_us', 'email')->value }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>


            <div class="ratio ratio-21x9 contact-map mt-70 mb-30">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583088354!2d-74.11976389828038!3d40.697663748695746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1615903229405!5m2!1sen!2sbd"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <section class="vs-team-wrapper space-top space-md-bottom" data-bg-src="assets/img/bg/bg-2.jpg">
            <div class="container">
                <div class="row  text-center justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="section-title text-center mb-5">
                            <span class="h3 text-theme sec-subtitle">
                                {{ __('label.medical_general_care') }}
                            </span>
                            <h2 class="h1">
                                {{ __('label.meet_our_doctors') }}
                            </h2>
                            <p class="text-muted mt-3">
                                {{ __('label.doctor_section_description') }}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="row vs-carousel wow fadeIn" data-wow-delay="0.3s" data-arrows="true" data-slide-show="3"
                    data-lg-slide-show="2">
                    @foreach ($doctors as $value)
                        <div class="col-xl-4 mb-30 wow fadeInUp" data-wow-delay="0.3s">
                            <div class="team-card">
                                <div class="team-head">
                                    <img src="{{ $value->admin?->getAttachment() }}" alt="{{ $value->admin?->name }}"
                                        class="w-100">
                                    <div class="team-card-links">
                                        <a class="team-links-toggler" href="#"><i class="fas fa-share-alt"></i></a>
                                        <div class="team-social">
                                            @if (!empty($value->facebook))
                                                <a href="{{ $value->facebook }}" target="_blank"><i
                                                        class="fab fa-facebook-f"></i></a>
                                            @endif

                                            @if (!empty($value->instagram))
                                                <a href="{{ $value->instagram }}" target="_blank"><i
                                                        class="fab fa-instagram"></i></a>
                                            @endif

                                            @if (!empty($value->whatsapp))
                                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $value->whatsapp) }}"
                                                    target="_blank">
                                                    <i class="fab fa-whatsapp" style="background-color: #25D366"></i>
                                                </a>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                                <div class="team-body">
                                    <h3 class="h4 mb-0"><a href="{{ route('front.doctors.show', $value->id) }}"
                                            class="text-reset">{{ $value->admin?->name }}</a></h3>
                                    <p class="fs-xs degi text-theme mb-2">{{ $value->specializations?->title }}</p>
                                    <p class="fs-xs"> {{ \Illuminate\Support\Str::words($value->about_us, 20, '...') }}
                                    </p>
                                    <div class="">
                                        <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a
                                                class="text-reset"
                                                href="tel:{{ $value->mobile }}">{{ $value->mobile }}</a>
                                        </p>
                                        <p class="fs-xs team-info"><i class="fas fa-envelope text-theme"></i><a
                                                class="text-reset"
                                                href="mailto:{{ $value->admin?->email }}">{{ $value->admin?->email }}</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
    </section>
@endsection
