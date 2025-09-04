  <header class="header-wrapper header-layout6">
      <!-- Header Top -->
      <div class="header-top-six bg-title d-none d-md-block">
          <div class="container container-style6">
              <div
                  class="row justify-content-center justify-content-lg-between justify-content-md-start align-items-center">
                  <div class="col-auto">
                      <ul class="header-top-info v6 list-unstyled m-0">
                          <li>{{__('label.welcome')}} <a href="#">{{settings('general','name')->value}}</a> </li>
                          <li><i class="far fa-clock"></i>Mon - Fri: 8:00 am - 7:00 pm</li>
                      </ul>
                  </div>
                  <div class="col-auto d-none d-lg-block">
                      <ul class="head-top-links v6 text-end">
                          <li>
                              <ul class="header-social v6">
                                  <li>
                                      <a href="#"><i class="fab fa-facebook-f"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fab fa-twitter"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                  </li>
                                  <li>
                                      <a href="#"><i class="fab fa-youtube"></i></a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" role="button" id="languageDropdown"
                                  data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="fal fa-globe"></i> {{ LaravelLocalization::getCurrentLocaleNative() }}
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                                  @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                      <li>
                                          <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                              href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                              {{ $properties['native'] }}
                                          </a>
                                      </li>
                                  @endforeach
                              </ul>
                          </li>


                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <!-- Sticky Active -->
      <div class="sticky-wrap">
          <div class="sticky-active">
              <!-- Header Main -->
              <div class="header-main6">
                  <div class="container container-style6 position-relative">
                      <div class="row align-items-center justify-content-between">
                          <div class="col-auto">
                              <div class="header1-logo py-2">
                                  <a href="{{route('home')}}"><img src="{{ asset('storage/' . settings('general', 'logo')->value) }}" alt="Logo"></a>
                              </div>
                          </div>
                          <div class="col d-lg-flex justify-content-end">
                              <div class="location-box one">
                                  <span class="fa fa-envelope"></span>
                                  <div class="content-box">
                                      <span class="text-title">{{__('label.Mail Us For Support')}}</span>
                                      <h6 class="title"><a href="#">{{settings('contact_us', 'email')->value}}</a></h6>
                                  </div>
                              </div>
                              <div class="location-box">
                                  <span class="fa fa-map-marker"></span>
                                  <div class="content-box">
                                      <span class="text-title">{{__('label.address')}}</span>
                                      <h6 class="title">{{settings('contact_us', 'location')->value}}</h6>
                                  </div>
                              </div>
                          </div>

                          <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fas fa-bars"></i></button>
                      </div>
                  </div>
              </div>
              <div class="header-lower-six">
                  <div class="container-style6">
                      <div class="outer-box">
                          <div class="nav-box">
                              <nav class="main-menu menu-style1 d-none d-lg-block">
                                  <ul>
                                      <li class="">
                                          <a href="{{route('home')}}"><span class="has-new-label">{{__('label.main')}}</span></a>

                                      </li>
                                      <li>
                                          <a href="about.html">About</a>
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
                                      <li class="menu-item-has-children mega-menu-wrap">
                                          <a href="#"><span class="has-new-label">Pages</span></a>
                                          <ul class="mega-menu">
                                              <li><a href="shop.html">Pagelist 1</a>
                                                  <ul>
                                                      <li><a href="index.html">Home One</a></li>
                                                      <li><a href="index-2.html">Home Two</a></li>
                                                      <li><a href="index-3.html">Home Three</a></li>
                                                      <li><a href="index-4.html">Home Four</a></li>
                                                      <li><a href="index-5.html">Home Five</a></li>
                                                      <li><a href="index-6.html">Home Six<span
                                                                  class="new-label">New</span></a></li>
                                                      <li><a href="index-7.html">Home Seven <span
                                                                  class="new-label">New</span></a></li>
                                                      <li><a href="index-8.html">Home Eight <span
                                                                  class="new-label">New</span></a></li>
                                                  </ul>
                                              </li>
                                              <li><a href="#">Pagelist 2</a>
                                                  <ul>
                                                      <li><a href="about.html">About Us</a></li>
                                                      <li><a href="service.html">Services</a></li>
                                                      <li><a href="service-details.html">Services Details</a></li>
                                                      <li><a href="team.html">Team</a></li>
                                                      <li><a href="team-details.html">Team Details</a></li>
                                                  </ul>
                                              </li>
                                              <li><a href="#">Pagelist 3</a>
                                                  <ul>
                                                      <li><a href="project.html">Projects</a></li>
                                                      <li><a href="shop.html">Our Shop <span
                                                                  class="new-label">New</span></a></li>
                                                      <li><a href="shop-details.html">Shop Details <span
                                                                  class="new-label">New</span></a></li>
                                                      <li><a href="cart.html">Shopping Cart <span
                                                                  class="new-label">New</span></a></li>
                                                      <li><a href="checkout.html">Checkout <span
                                                                  class="new-label">New</span></a></li>
                                                  </ul>
                                              </li>
                                              <li><a href="#">Pagelist 4</a>
                                                  <ul>
                                                      <li><a href="blog.html">Blog</a></li>
                                                      <li><a href="blog-details.html">Blog Details</a></li>
                                                      <li><a href="appointment.html">Appointment</a></li>
                                                      <li><a href="contact.html">Contact Us</a></li>
                                                      <li><a href="error.html">Error Page</a></li>
                                                  </ul>
                                              </li>
                                          </ul>
                                      </li>
                                      <li>
                                          <a href="contact.html">Contact</a>
                                      </li>
                                  </ul>
                              </nav>
                              <button class="vs-menu-toggle d-inline-block d-lg-none"><i
                                      class="fas fa-bars"></i></button>
                          </div>
                          <div class="btn-box-six">
                              <a href="#" class="contact-btn"><i class="fa fa-phone"></i>Call Anytime:669 2568
                                  2596</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>
