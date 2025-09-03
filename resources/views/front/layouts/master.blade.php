<!doctype html>
<html lang="ar" dir="rtl">
@include('front.layouts.head')


<body>

    <div class="preloader  ">
        <button class="vs-btn preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <svg width="88px" height="108px" viewBox="0 0 54 64">
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <path class="beat-loader"
                        d="M0.5,38.5 L16,38.5 L19,25.5 L24.5,57.5 L31.5,7.5 L37.5,46.5 L43,38.5 L53.5,38.5"
                        id="Path-2" stroke-width="2"></path>
                </g>
            </svg>
        </div>
    </div>
    <!--==============================
    Mobile Menu
    ============================== -->
    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="index.html"><img src="assets/img/logo-mobile.svg" alt="Medixi"></a>
            </div>
            <form action="#" class="mobile-menu-form">
                <input type="text" class="form-control" placeholder="Search...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            <div class="vs-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="index.html">Home</a>
                        <ul class="sub-menu">
                            <li><a href="index.html">Home One</a></li>
                            <li><a href="index-2.html">Home Two</a></li>
                            <li><a href="index-3.html">Home Three</a></li>
                            <li><a href="index-4.html">Home Four </a></li>
                            <li><a href="index-5.html">Home Five</a></li>
                            <li><a href="index-6.html">Home Six <span class="new-label">New</span></a></li>
                            <li><a href="index-7.html">Home Seven <span class="new-label">New</span></a></li>
                            <li><a href="index-8.html">Home Eight <span class="new-label">New</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="about.html">About Us</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="service.html">Services</a>
                        <ul class="sub-menu">
                            <li><a href="service.html">Services</a></li>
                            <li><a href="service-details.html">Services Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="blog.html">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog.html">Blog</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="shop.html">Our Shop <span class="new-label">New</span></a></li>
                            <li><a href="shop-details.html">Shop Details <span class="new-label">New</span></a></li>
                            <li><a href="cart.html">Shopping Cart <span class="new-label">New</span></a></li>
                            <li><a href="checkout.html">Checkout <span class="new-label">New</span></a></li>
                            <li><a href="team.html">Team</a></li>
                            <li><a href="team-details.html">Team Details</a></li>
                            <li><a href="project.html">Projects</a></li>
                            <li><a href="appointment.html">Appointment</a></li>
                            <li><a href="error.html">Error Page</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="contact.html">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
    Sidemenu
    ============================== -->
    <div class="sidemenu-wrapper d-none d-lg-block" s>
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <div class="widget footer-widget  ">
                <div class="vs-widget-about">
                    <div class="footer-logo">
                        <img src="assets/img/logo.svg" alt="logo">
                    </div>
                    <p class="footer-text1">Lorem ipsum dolor sit amet, consectet eiusmod tempor incididunt ut labore e
                        rem ipsum dolor sit amet. sum dolor sit amet, consectet eiusmod.</p>
                    <div class="footer-social3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="widget footer-widget   ">
                <h3 class="widget_title">Visiting Hours</h3>
                <div class="footer-table">
                    <table>
                        <tr>
                            <td>Mon - Fri:</td>
                            <td>8:00 am - 8:00 pm</td>
                        </tr>
                        <tr>
                            <td>Saturday:</td>
                            <td>9:00 am - 6:00 pm</td>
                        </tr>
                        <tr>
                            <td>Sunday:</td>
                            <td>9:00 am - 6:00 pm</td>
                        </tr>
                    </table>
                </div>
                <div class="address-line">
                    <i class="far fa-map-marker-alt text-theme fs-md"></i>
                    <a href="#" class="text-reset fs-md">374 William S Canning Blvd, Fall River MA 2721</a>
                </div>
            </div>
            <div class="widget footer-widget  ">
                <h4 class="widget_title">Gallery Posts</h4>
                <div class="footer-gallery">
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-1.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-2.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-3.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-4.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-5.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                    <div class="gal-item">
                        <a href="#"><img src="assets/img/widget/gal-1-6.jpg" alt="Gallery Image"
                                class="w-100"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
    Popup Search Box
    ============================== -->
    <div class="popup-search-box d-none d-lg-block  ">
        <button class="searchClose border-theme text-theme"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" class="border-theme" placeholder="What are you looking for">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>




    @include('front.layouts.header')
   <section class="vs-hero-wrapper6 position-relative" data-bg-src="assets/img/bg/banner6-1.jpg">
        <div class="container-style6">
            <div class="hero-content6">
                <span class="sub-title wow fadeInUp" data-wow-delay="200ms">Quality Theraphy Starts From here</span>
                <h1 class="title wow fadeInUp" data-wow-delay="300ms">We Always Put The Patients First</h1>
                <p  class=" wow fadeInUp" data-wow-delay="400ms">Ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at augue.
                    The Non odio nam euismod lacinia at quis risus. In dictum non consectetur
                    a erat nam at lectus. Orci sagittis eu volutpat odio facilisis.
                </p>
                <a href="#" class="btn-style wow fadeInUp" data-wow-delay="500ms">Explore Our Services</a>
            </div>
        </div>
    </section>
    <!-- End hero section -->

    <!-- form-section -->
    <sectiion class="form-section">
        <div class="container-style6">
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
                            <input type="text" class="dateTime-pick form-control  style2" placeholder="Select Date & Time">
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
    </sectiion>



    <section class="main-section space" data-bg-src="assets/img/bg/ser-bg9-1.jpg"  style="direction: ltr">
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
                                        data-bs-target="#cardiac" type="button" role="tab"
                                        aria-controls="cardiac" aria-selected="false"><i
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
                                        data-bs-target="#breast" type="button" role="tab"
                                        aria-controls="breast" aria-selected="false"><i class="fa fa-plus"></i>Breast
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
                                    <button class="nav-link" id="eye-tab" data-bs-toggle="tab"
                                        data-bs-target="#eye" type="button" role="tab" aria-controls="eye"
                                        aria-selected="false"><i class="fa fa-plus"></i>Eye Care</button>
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
                            <div class="tab-pane fade" id="neurology" role="tabpanel"
                                aria-labelledby="neurology-tab">
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


    <section class="team-section-two space" data-bg-src="assets/img/bg/team2-1.jpg" >
        <div class="container-style6">
            <div class="title-area-two wow fadeInUp" data-wow-delay="400ms">
                <span class="sub-title6">Our Special Doctors</span>
                <h2>Meet Our Expert <br>Doctors</h2>
            </div>
            <div class="row vs-carousel wow fadeIn" data-wow-delay="0.3s" data-slide-show="4" data-lg-slide-show="3"
                data-md-slide-show="2" data-sm-slide-show="1"  style="direction: ltr">
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-1.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Thomas Mingle</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="500ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-2.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Lisa Herndon</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-3.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">James Turner</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="700ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-4.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Sylvia Sanchez</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-1.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Thomas Mingle</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="500ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-2.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Lisa Herndon</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="600ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-3.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">James Turner</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Team block -->
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="700ms">
                    <div class="team-card-two">
                        <div class="team-img-six">
                            <img src="assets/img/team/team2-4.jpg" alt="">
                        </div>
                        <div class="info-box">
                            <h4 class="name"><a href="#">Sylvia Sanchez</a></h4>
                            <span class="designation">Kids Specialist</span>
                            <span class="share-icon fa fa-share-alt"></span>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
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
                        <a href="service.html" class="icon-btn style4"><i
                                class="far fa-long-arrow-alt-right"></i></a>
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
                        <a href="service.html" class="icon-btn style4"><i
                                class="far fa-long-arrow-alt-right"></i></a>
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
                        <a href="service.html" class="icon-btn style4"><i
                                class="far fa-long-arrow-alt-right"></i></a>
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
                        <a href="service.html" class="icon-btn style4"><i
                                class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="vs-blog-wrapper-seven space space-md-top"  style="direction: ltr">
        <div class="container">
            <div class="row  text-center justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-6 wow fadeIn" data-wow-delay="400ms">
                    <div class="title-area-three text-center">
                        <span class="sub-title7">Our Blogs</span>
                        <h2>You get every single<br> news feeds.</h2>
                    </div>
                </div>
            </div>
            <div class="row vs-carousel wow fadeInUp" data-wow-delay="0.3s" data-slide-show="3"
                data-lg-slide-show="2">
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
    @include('front.layouts.footer')
    @include('front.layouts.scripts')
</body>



</html>
