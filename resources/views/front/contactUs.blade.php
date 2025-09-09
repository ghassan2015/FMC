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
                        <li><a href="{{ route('home') }}">{{ __('label.main') }}</a></li>
                        <li class="active">{{ __('label.contact_us') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--==============================
              Contact Form Area
            ==============================-->
    <section class="vs-contact-wrapper vs-contact-layout1 space-top space-md-bottom">
        <div class="container">
            <div class="row gx-60 align-items-center">
                <!-- Contact Form -->
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <form action="{{ route('front.contactUs.store') }}" id="my-form-contact-us" name="my-form-contact-us"
                        method="POST" class="ajax-contact form-wrap3 mb-30" data-bg-color="#f3f6f7">
                        @csrf
                        <div class="form-title">
                            <h3 class="mt-n2 fls-n2 mb-0">{{ __('label.send_message') }}</h3>
                            <p class="text-theme mb-4">{{ __('label.send_message_note') }}</p>
                        </div>
                        <div class="form-group mb-15">
                            <input type="text" class="form-control style3" name="name" id="name"
                                placeholder="{{ __('label.name') }}" required>
                            <i class="fal fa-user"></i>
                        </div>
                        <div class="form-group mb-15">
                            <input type="email" class="form-control style3" name="email" id="email"
                                placeholder="{{ __('label.email') }}" required>
                            <i class="fal fa-envelope"></i>
                        </div>
                        <div class="form-group mb-15">
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control style3"
                                placeholder="{{ __('label.message') }}" required></textarea>
                            <i class="fal fa-pencil-alt"></i>
                        </div>
                        <div class="form-btn pt-15">
                            <button class="vs-btn style2" type="submit" id="submit-button">
                                {{ __('label.send') }} <i class="fas fa-chevron-right"></i>


                                <span id="spinner" style="display:none;">
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-6">
                    <div class="contact-information mb-30">
                        <h2 class="mt-n2">{{ __('label.contact_intro') }}</h2>
                        <div class="row">
                            <div class="col-xxl-10">
                                <p>{{ __('label.contact_description') }}</p>
                            </div>
                        </div>

                        <h3 class="h4 pt-2 mb-10">{{ __('label.work_hours') }}</h3>
                        <table class="contact-info-table">
      @php
                    // الأيام بالعربية والإنجليزية
                    $days = [
                        'Saturday' => ['en' => 'Saturday', 'ar' => 'السبت'],
                        'Sunday' => ['en' => 'Sunday', 'ar' => 'الأحد'],
                        'Monday' => ['en' => 'Monday', 'ar' => 'الاثنين'],
                        'Tuesday' => ['en' => 'Tuesday', 'ar' => 'الثلاثاء'],
                        'Wednesday' => ['en' => 'Wednesday', 'ar' => 'الأربعاء'],
                        'Thursday' => ['en' => 'Thursday', 'ar' => 'الخميس'],
                        'Friday' => ['en' => 'Friday', 'ar' => 'الجمعة'],
                    ];

                    // الحصول على اللغة الحالية
                    $locale = app()->getLocale(); // 'ar' أو 'en'
                @endphp


                            @foreach ($workHours as $value)
                                <tr>
                                    <td>{{$days[$value->date][$locale] ?? $value->date  }}</td>
                                    <td>{{ formatTime($value->time_in) }} -
                                        {{ formatTime($value->time_out) }}</td>
                                </tr>


                            @endforeach
                        </table>

                        <h4 class="pt-2 mb-10">{{ __('label.address') }}</h4>
                        <p class="fs-md"><i
                                class="far fa-map-marker-alt me-2"></i>{{ settings('contact_us', 'location')->value }}</p>

                        <h4 class="pt-2 mb-2">{{ __('label.customer_support') }}</h4>
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
        </div>
        </div>

        <!-- Google Map -->
        <div class="ratio ratio-21x9 contact-map mt-70 mb-30">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.1583088354!2d-74.11976389828038!3d40.697663748695746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1615903229405!5m2!1sen!2sbd"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        </div>
    </section>
@endsection
