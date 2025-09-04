@extends('front.layouts.master')
@section('content')

    @if ($banners)
        <section class="vs-hero-wrapper-eight position-relative">
            <div class="banner-slide-eight">
                @foreach ($banners as $value)
                    <div class="banner-slide">
                        <div class="banner-content">
                            <img src="{{ $value->logo }}" alt="">
                            <div class="banner-text">
                                <div class="container-style8">
                                    <div class="banner-sec-info one-time">
                                        <h1 class="animated" data-animation-in="fadeInUp" data-delay-in="0.1">
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
    <section class="main-section space" data-bg-src="assets/img/bg/review-bg.jpg">
        <div class="service-section-nine m-3">
            <form action="#" class="form-wrap1">
                <div class="form-box-two">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="400ms">
                            <input type="text" class="form-control  style2" placeholder="Your Name">
                            <i class="fal small fa-user"></i>
                        </div>
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="500ms">
                            <input type="email" class="form-control  style2" placeholder="Email Address">
                            <i class="fal small fa-envelope"></i>
                        </div>
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="600ms">
                            <input type="text" class="dateTime-pick form-control  style2"
                                placeholder="Select Date & Time">
                            <i class="fal small fa-calendar-alt"></i>
                        </div>
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="400ms">
                            <select class="form-select style2">
                                <option hidden disabled selected>Choose Doctor</option>
                                <option>Aerospace Medicine</option>
                                <option>Bariatric Surgery</option>
                                <option>Infectious Diseases</option>
                                <option>Laboratory Medicine</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="500ms">
                            <select class="form-select style2">
                                <option hidden disabled selected>Select Services</option>
                                <option>Aerospace Medicine</option>
                                <option>Bariatric Surgery</option>
                                <option>Infectious Diseases</option>
                                <option>Laboratory Medicine</option>
                            </select>
                        </div>
                        <div class="col-xl-4 col-md-6 form-group wow fadeInUp" data-wow-delay="600ms">
                            <button type="submit" class="btn-style">Make Appointment</button>
                        </div>
                    </div>
                </div>
            </form>
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
                                    <button class="nav-link" id="cardiac-tab" data-bs-toggle="tab" data-bs-target="#cardiac"
                                        type="button" role="tab" aria-controls="cardiac" aria-selected="false"><i
                                            class="fa fa-plus"></i>Cardiac Care</button>
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
                    <div class="section-title">
                        <span class="h3 text-theme sec-subtitle">Medical & General Care!</span>
                        <h2 class="h1">Meet Our Doctors</h2>
                        <p>Proactively revolutionize granular customer service after pandemic internal or "organic" sources
                            istinctively impact proactive human</p>
                    </div>
                </div>
            </div>
            <div class="row vs-carousel wow fadeIn" data-wow-delay="0.3s" data-arrows="true" data-slide-show="3"
                data-lg-slide-show="2">
                <div class="col-xl-4 mb-30">
                    <div class="team-card">
                        <div class="team-head">
                            <img src="assets/img/team/t-1-1.png" alt="Team Area" class="w-100">
                            <div class="team-card-links">
                                <a class="team-links-toggler" href="#"><i class="fas fa-share-alt"></i></a>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-basketball-ball"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-body">
                            <h3 class="h4 mb-0"><a href="team-details.html" class="text-reset">David Smith</a></h3>
                            <p class="fs-xs degi text-theme mb-2">Specialist</p>
                            <p class="fs-xs">Conceptualize user-centric web-readiness via economically sound e-services.
                                Interactively coordinate next-generation </p>
                            <div class="">
                                <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a class="text-reset"
                                        href="tel:+592201520156">+592 2015 20156</a></p>
                                <p class="fs-xs team-info"><i class="fas fa-envelope text-theme"></i><a
                                        class="text-reset" href="mailto:info.example@mail.com">info.example@mail.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="team-card">
                        <div class="team-head">
                            <img src="assets/img/team/t-1-2.png" alt="Team Area" class="w-100">
                            <div class="team-card-links">
                                <a class="team-links-toggler" href="#"><i class="fas fa-share-alt"></i></a>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-basketball-ball"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-body">
                            <h3 class="h4 mb-0"><a href="team-details.html" class="text-reset">Vivi Marian</a></h3>
                            <p class="fs-xs degi text-theme mb-2">Osteopathic</p>
                            <p class="fs-xs">Conceptualize user-centric web-readiness via economically sound e-services.
                                Interactively coordinate next-generation </p>
                            <div class="">
                                <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a class="text-reset"
                                        href="tel:+592201520156">+592 2015 20156</a></p>
                                <p class="fs-xs team-info"><i class="fas fa-envelope text-theme"></i><a
                                        class="text-reset" href="mailto:info.example@mail.com">info.example@mail.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="team-card">
                        <div class="team-head">
                            <img src="assets/img/team/t-1-3.png" alt="Team Area" class="w-100">
                            <div class="team-card-links">
                                <a class="team-links-toggler" href="#"><i class="fas fa-share-alt"></i></a>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-basketball-ball"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-body">
                            <h3 class="h4 mb-0"><a href="team-details.html" class="text-reset">Farhan Moris</a></h3>
                            <p class="fs-xs degi text-theme mb-2">Pediatrician</p>
                            <p class="fs-xs">Conceptualize user-centric web-readiness via economically sound e-services.
                                Interactively coordinate next-generation </p>
                            <div class="">
                                <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a class="text-reset"
                                        href="tel:+592201520156">+592 2015 20156</a></p>
                                <p class="fs-xs team-info"><i class="fas fa-envelope text-theme"></i><a
                                        class="text-reset" href="mailto:info.example@mail.com">info.example@mail.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 mb-30">
                    <div class="team-card">
                        <div class="team-head">
                            <img src="assets/img/team/t-1-4.png" alt="Team Area" class="w-100">
                            <div class="team-card-links">
                                <a class="team-links-toggler" href="#"><i class="fas fa-share-alt"></i></a>
                                <div class="team-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fas fa-basketball-ball"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="team-body">
                            <h3 class="h4 mb-0"><a href="team-details.html" class="text-reset">Jerzzy Lamot</a></h3>
                            <p class="fs-xs degi text-theme mb-2">Surgeon</p>
                            <p class="fs-xs">Conceptualize user-centric web-readiness via economically sound e-services.
                                Interactively coordinate next-generation </p>
                            <div class="">
                                <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a class="text-reset"
                                        href="tel:+592201520156">+592 2015 20156</a></p>
                                <p class="fs-xs team-info"><i class="fas fa-envelope text-theme"></i><a
                                        class="text-reset" href="mailto:info.example@mail.com">info.example@mail.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="vs-service-wrapper space-top space-md-bottom" data-bg-src="assets/img/bg/bg-6.jpg">
        <div class="container">
            <div class="row  text-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <div class="sec-icon">
                            <i class="flaticon-ecg"></i>
                        </div>
                        <h2 class="h1 ">Get Our Services</h2>
                        <p>Proactively revolutionize granular customer service after pandemic internal or "organic"
                            sources istinctively impact proactive human</p>
                    </div>
                </div>
            </div>
            <div class="row vs-carousel wow fadeIn" data-wow-delay="0.3s" data-slide-show="3">
                <div class="col-xl-4 mb-25">
                    <div class="service-box ">
                        <div class="sr-img">
                            <img src="assets/img/service/sr-2-1.jpg" alt="Service Image" class="w-100">
                        </div>
                        <div class="sr-icon">
                            <i class="flaticon-computer-mouse"></i>
                        </div>
                        <div class="sr-content">
                            <h3 class="h4"><a class="text-reset" href="service.html">Medical Advices &
                                    Checkup</a></h3>
                            <p class="fs-xs">Continually evisculate goal-oriented portals rather than prospective
                                channels. excellent customize life</p>
                        </div>
                        <a href="service.html" class="icon-btn style4"><i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 mb-25">
                    <div class="service-box ">
                        <div class="sr-img">
                            <img src="assets/img/service/sr-2-2.jpg" alt="Service Image" class="w-100">
                        </div>
                        <div class="sr-icon">
                            <i class="flaticon-blood-pressure"></i>
                        </div>
                        <div class="sr-content">
                            <h3 class="h4"><a class="text-reset" href="service.html">Cardiovascular for
                                    Women's</a></h3>
                            <p class="fs-xs">Continually evisculate goal-oriented portals rather than prospective
                                channels. excellent customize life</p>
                        </div>
                        <a href="service.html" class="icon-btn style4"><i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 mb-25">
                    <div class="service-box ">
                        <div class="sr-img">
                            <img src="assets/img/service/sr-2-3.jpg" alt="Service Image" class="w-100">
                        </div>
                        <div class="sr-icon">
                            <i class="flaticon-stethoscope-1"></i>
                        </div>
                        <div class="sr-content">
                            <h3 class="h4"><a class="text-reset" href="service.html">Heart Checkup or
                                    Cardiovascular</a></h3>
                            <p class="fs-xs">Continually evisculate goal-oriented portals rather than prospective
                                channels. excellent customize life</p>
                        </div>
                        <a href="service.html" class="icon-btn style4"><i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 mb-25">
                    <div class="service-box ">
                        <div class="sr-img">
                            <img src="assets/img/service/sr-2-4.jpg" alt="Service Image" class="w-100">
                        </div>
                        <div class="sr-icon">
                            <i class="flaticon-quality-of-life"></i>
                        </div>
                        <div class="sr-content">
                            <h3 class="h4"><a class="text-reset" href="service.html">Laboratory & Pathology
                                    Drag</a></h3>
                            <p class="fs-xs">Continually evisculate goal-oriented portals rather than prospective
                                channels. excellent customize life</p>
                        </div>
                        <a href="service.html" class="icon-btn style4"><i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-blog-wrapper-seven space space-md-top">
        <div class="container">
            <div class="row  text-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6 wow fadeIn" data-wow-delay="400ms">
                    <div class="title-area-three text-center">
                        <span class="sub-title7">Our Blogs</span>
                        <h2>You get every single<br> news feeds.</h2>
                    </div>
                </div>
            </div>
            <div class="row vs-carousel wow fadeInUp" data-wow-delay="0.3s" data-slide-show="3" data-lg-slide-show="2">
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="400ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-1.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">What does your blood type
                                    have to do with your health?</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="500ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-2.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">Healthy habits to reduce
                                    the risks of heart diseases</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="600ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-3.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">Why men should stay on top
                                    of health screenings</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="400ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-1.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">What does your blood type
                                    have to do with your health?</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="500ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-2.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">Healthy habits to reduce
                                    the risks of heart diseases</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="600ms">
                    <div class="vs-blog blog-card-seven">
                        <div class="blog-img-seven">
                            <img src="assets/img/blog/b-7-3.jpg" alt="Blog Image" class="w-100">
                            <a href="#" class="search-icon"><i class="far fa-search"></i></a>
                            <div class="blog-date-seven">
                                <span>18 July, 2022</span>
                            </div>
                        </div>
                        <div class="blog-content-seven">
                            <div class="blog-meta-seven">
                                <a href="blog.html"><i class="fa fa-user"></i>Admin</a>
                                <a href="blog.html"><i class="fa fa-comments"></i>Comments</a>
                            </div>
                            <h3 class="blog-title h5 font-body lh-base"><a href="blog.html">Why men should stay on top
                                    of health screenings</a></h3>
                            <a href="blog.html" class="btn-style7 v6 wow fadeInUp animated">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
