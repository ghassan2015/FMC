  <header class="header-wrapper header-layout6">
      <!-- Header Top -->
      <div class="header-top-six bg-title d-none d-md-block">
          <div class="container container-style6">
              <div
                  class="row justify-content-center justify-content-lg-between justify-content-md-start align-items-center">
                  <div class="col-auto">
                      {{-- <ul class="header-top-info v6 list-unstyled m-0">
                          <li>{{__('label.welcome')}} <a href="#">{{settings('general','name')->value}}</a> </li>
                      </ul> --}}
                      
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
                              <div class="header1-logo">
                                  <a href="{{route('home')}}"><img
                                    style="width:160px"
                                    src="{{ asset('storage/' . settings('general', 'logo')->value) }}" alt="Logo"></a>
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
                                          <a href="{{route('front.aboutUs')}}">{{__('label.about_us')}}</a>
                                      </li>
                                              <li>
                                          <a href="{{route('front.doctors')}}">{{__('label.doctors')}}</a>
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
                                      </li>
                                              <li>
                                          <a href="{{route('front.articles.index')}}">{{__('label.articales')}}</a>
                                      </li>
                                      </li>
                                          </li>
                                              <li>
                                          <a href="{{route('front.video')}}">{{__('label.videoes')}}</a>
                                      </li>
                                      <li>
                                          <a href="{{route('front.contactUs')}}">{{__('label.contact_title')}}</a>
                                      </li>
                                  </ul>
                              </nav>
                              <button class="vs-menu-toggle d-inline-block d-lg-none"><i
                                      class="fas fa-bars"></i></button>
                          </div>
                          <div class="btn-box-six">
                              <a href="#" class="contact-btn"><i class="fa fa-phone"></i>{{__('label.mobile')}}:
                                <span>
                                {{settings('contact_us','mobile')->value}}
                                </span>
                            </a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </header>
