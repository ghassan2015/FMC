@extends('front.layouts.master')
@section('content')

    @if ($banners)
        <section class="vs-hero-wrapper-eight position-relative">
            <div class="banner-slide-eight">
                @foreach ($banners as $value)
                    <div class="banner-slide">
                        <div class="banner-content">
                            <img src="{{ $value->photo }}" alt="">
                            <div class="banner-text">
                                <div class="container-style8">
                                    <div class="banner-sec-info one-time">
                                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.1">
                                            {{-- {{ $value->created_at->translatedFormat('d F Y') }} --}}
                                            {{ $value->title }}
                                        </h1>
                                        <p class="animated" data-animation-in="fadeInUp" data-delay-in="0.3">
                                            {!! $value->description !!}
                                        </p>

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>
                @endforeach
            </div>
    @endif

    <div class="banner-arrows">
        <div class="container-style8">
            <div id="slidenav3" class="custom-arrows-eight"></div>
        </div>
    </div>
    </section>


    <!-- form-section -->
    <section class="appointment-wrapper space-top space-md-bottom"
        data-bg-src="{{ asset('assets/img/bg/bg-shape-3.jpg') }}">
        <div class="container">
            <div class="row">

                <div class="col-xl-12 mb-30 pt-30 pt-xl-0">
                    <form action="{{ route('front.appointments.store') }}" method="POST"
                        class="form-wrap1 bg-white wow fadeInUp" id="my-form-apointment" name="my-form-apointment"
                        data-wow-delay="0.3s">

                        @csrf

                        <div class="form-title-box bg-title">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <h2 class="h4 mb-1 text-white">{{ __('label.Book An Appointment') }}</h2>
                                    <p class="mb-0 text-white-light">{{ __('label.Please Call Us To Ensure') }}</p>
                                </div>
                                <div class="col-auto d-none d-sm-block">
                                    <a href="{{ 'https://wa.me/' . settings('contact_us', 'whatsapp')->value }}"
                                        target="_black" class="ripple-icon style2"><i class="fas fa-phone"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-box">

                            <div class="row">

                                <div class="col-xl-6 form-group">
                                    <input type="text" name="name" required class="form-control  style2"
                                        placeholder="{{ __('label.name') }}">
                                    <i class="fal small fa-user"></i>
                                </div>
                                <div class="col-xl-6 form-group">
                                    <input type="email" name="email" required class="form-control  style2"
                                        placeholder="{{ __('label.email') }}">
                                    <i class="fal small fa-envelope"></i>
                                </div>
                                <div class="col-xl-6 form-group">
                                    <input type="number" name="mobile" required class="form-control  style2"
                                        placeholder="{{ __('label.mobile') }}">
                                    <i class="fal small fa-phone"></i>
                                </div>


                                <div class="col-xl-6 form-group">
                                    <input type="text" class="form-control  style2" name="id_number" required
                                        placeholder="{{ __('label.id_number') }}">
                                </div>
                                <div class="col-xl-6 form-group">
                                    <select class="form-select style2" id="AppointmentBranch" name="branch_id" required>


                                        <option disabled selected>{{ __('label.display_all_branches') }}</option>

                                        @foreach ($branches as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 form-group">
                                    <select class="form-select style2" id="doctorAppointment" name="doctor_id" required>
                                        <option disabled selected>{{ __('label.display_all_doctors') }}</option>
                                    </select>
                                </div>

                                <div class="col-xl-6 form-group">
                                    <input type="text" class="date-pick form-control  style2" name="date" required
                                        id="appointmentDate" placeholder="{{ __('label.select_date') }}">
                                    <i class="fal small fa-calendar-alt"></i>
                                </div>

                                <div class="" id="availableTimes"></div>
                                <div class="col-xl-12 text-center">
                                    <button type="submit"id="submit-button"
                                        class="vs-btn style2">{{ __('label.make_appointment') }}<i
                                            class="far fa-calendar-alt"></i>

                                        <span id="spinner" style="display:none;">
                                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="main-section space" data-bg-src="assets/img/bg/ser-bg9-1.jpg">
        <!-- service-section-nine -->
        <div class="service-section-nine">
            <div class="container-style8">
                <div class="title-area-four text-center  wow fadeInUp" data-wow-delay="400ms">
                    <span class="sub-title8">Medical Services</span>
                    <h2>What Facilities We Provided</h2>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-12 col-sm-12">
                        <div class="service-tabs">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="gastroenterology-tab" data-bs-toggle="tab"
                                        data-bs-target="#gastroenterology" type="button" role="tab"
                                        aria-controls="gastroenterology" aria-selected="true"><i
                                            class="fa fa-plus"></i>Gastroenterology</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="cardiac-tab" data-bs-toggle="tab"
                                        data-bs-target="#cardiac" type="button" role="tab" aria-controls="cardiac"
                                        aria-selected="false"><i class="fa fa-plus"></i>Cardiac Care</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="paediatrics-tab" data-bs-toggle="tab"
                                        data-bs-target="#paediatrics" type="button" role="tab"
                                        aria-controls="paediatrics" aria-selected="false"><i
                                            class="fa fa-plus"></i>Paediatrics</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="breast-tab" data-bs-toggle="tab"
                                        data-bs-target="#breast" type="button" role="tab" aria-controls="breast"
                                        aria-selected="false"><i class="fa fa-plus"></i>Breast
                                        Cancer</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="dermatology-tab" data-bs-toggle="tab"
                                        data-bs-target="#dermatology" type="button" role="tab"
                                        aria-controls="dermatology" aria-selected="false"><i
                                            class="fa fa-plus"></i>Dermatology</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="neurology-tab" data-bs-toggle="tab"
                                        data-bs-target="#neurology" type="button" role="tab"
                                        aria-controls="neurology" aria-selected="false"><i
                                            class="fa fa-plus"></i>Neurology</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="eye-tab" data-bs-toggle="tab" data-bs-target="#eye"
                                        type="button" role="tab" aria-controls="eye" aria-selected="false"><i
                                            class="fa fa-plus"></i>Eye Care</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12 col-sm-12">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="gastroenterology" role="tabpanel"
                                aria-labelledby="gastroenterology-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Gastroenterology</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-1.png" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="cardiac" role="tabpanel" aria-labelledby="cardiac-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Cardiac Care</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-2.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="paediatrics" role="tabpanel"
                                aria-labelledby="paediatrics-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Paediatrics</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-3.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="breast" role="tabpanel" aria-labelledby="breast-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Breast Cancer</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-4.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="dermatology" role="tabpanel"
                                aria-labelledby="dermatology-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Dermatology</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-5.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="neurology" role="tabpanel" aria-labelledby="neurology-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Neurology</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-6.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="eye" role="tabpanel" aria-labelledby="eye-tab">
                                <div class="service-tab-content">
                                    <h4 class="title">Eye Care</h4>
                                    <p>There are many variations Lorem Ipsum availab.There are many of pas ofb.There are
                                        many variations.</p>
                                    <ul class="ser-list-nine">
                                        <li>Invasive (infiltrating) ductal carcinoma</li>
                                        <li>Lobular breast cancer</li>
                                        <li>Ductal carcinoma in situ (DCIS)</li>
                                        <li>Triple-negative breast cancer (TNBC)</li>
                                    </ul>
                                    <a href="#" class="ser-btn-nine">Learn More</a>
                                    <div class="ser-img-nine">
                                        <img src="assets/img/service/ser9-3.jpg" alt="">
                                        <div class="icon-box"><img src="assets/img/service/ser9-2.svg" class="image"
                                                alt=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End service-section-nine -->
        <!-- service-section-ten -->

    </section>


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
                                <p class="fs-xs"> {{ \Illuminate\Support\Str::words($value->about_us, 20, '...') }}</p>
                                <div class="">
                                    <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a
                                            class="text-reset" href="tel:{{ $value->mobile }}">{{ $value->mobile }}</a>
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
    @if ($services)
        <section class="vs-service-wrapper space-top space-md-bottom" data-bg-src="assets/img/bg/bg-6.jpg">
            <div class="container">
                <!-- عنوان القسم -->
                <div class="row text-center justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="section-title">
                            <div class="sec-icon">
                                <i class="flaticon-ecg"></i>
                            </div>
                            <h2 class="h1">{{ __('label.get_our_services') }}</h2>
                            <p>{{ __('label.services_subtitle') }}</p>
                        </div>
                    </div>
                </div>

                <!-- قائمة الخدمات -->
                <div class="row vs-carousel wow fadeIn" data-wow-delay="0.3s" data-slide-show="3">
                    @foreach ($services as $service)
                        <div class="col-xl-4 mb-25">
                            <div class="service-box shadow-sm rounded-3 overflow-hidden text-center p-3">
                                <!-- صورة الخدمة -->
                                @if ($service->photo)
                                    <div class="sr-img mb-3 text-center">
                                        <img src="{{ $service->photo }}" alt="{{ $service->name }}" class="rounded"
                                            style="width: 150px; height: auto; object-fit: cover;">
                                    </div>
                                @endif

                                <!-- أيقونة الخدمة -->
                                @if ($service->icon_logo)
                                    <div class="sr-icon mb-2">
                                        <img src="{{ $service->icon_logo }}" alt="{{ $service->name }} Icon"
                                            class="icon-logo" style="width:50px; height:50px;">
                                    </div>
                                @elseif($service->icon)
                                    <div class="sr-icon mb-2">
                                        <i class="{{ $service->icon }}"></i>
                                    </div>
                                @endif

                                <!-- محتوى الخدمة -->
                                <div class="sr-content">
                                    <h3 class="h5 mb-2">
                                        <a class="text-reset fw-bold" href="#">{{ $service->name }}</a>
                                    </h3>
                                    <p class="fs-sm text-muted mb-0">
                                        {{ \Illuminate\Support\Str::words($service->description, 20, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="vs-blog-wrapper-seven space space-md-top">
        <div class="container">
            <!-- Title -->
            <div class="row text-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6 wow fadeIn" data-wow-delay="400ms">
                    <div class="title-area-three text-center">
                        <span class="sub-title7">{{ __('label.our_blogs') }}</span>
                        <h2>{{ __('label.blogs_subtitle') }}</h2>
                    </div>
                </div>
            </div>

            <!-- Blog Carousel -->
            <div class="row vs-carousel wow fadeInUp" data-wow-delay="0.3s" data-slide-show="3" data-lg-slide-show="2">
                @foreach ($articles as $key => $article)
                    <div class="col-xl-4 wow fadeInUp" data-wow-delay="{{ 400 + $key * 100 }}ms">
                        <div class="vs-blog blog-card-seven shadow-sm rounded-3 overflow-hidden h-100">
                            <!-- Blog Image -->
                            <div class="blog-img-seven position-relative">
                                <img src="{{ $article->photo }}" alt="{{ $article->title }}" class="w-100 rounded-top">
                                <a href="{{ route('front.articles.show', $article->slug) }}" class="search-icon">
                                    <i class="far fa-search"></i>
                                </a>
                                <div class="blog-date-seven">
                                    <span>{{ $article->created_at->format('d M, Y') }}</span>
                                </div>
                            </div>

                            <!-- Blog Content -->
                            <div class="blog-content-seven p-3 d-flex flex-column justify-content-between h-100">
                                <div>
                                    <div class="blog-meta-seven mb-2">
                                        <a href="#" class="text-muted"><i class="fa fa-stethoscope"></i>
                                            {{ $article->specializations?->name ?? 'General' }}</a>
                                    </div>
                                    <h3 class="blog-title h5 font-body lh-base mb-2">
                                        <a href="{{ route('front.articles.show', $article->slug) }}"
                                            class="text-reset fw-bold">
                                            {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                                        </a>
                                    </h3>
                                    <p class="fs-sm text-muted mb-3">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 80) }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
