<footer class="footer-wrapper footer-layout7" data-bg-src="{{ asset('assets/img/bg/footer-bg-7-1.jpg') }}">
    <div class="widget-area v7">
        <div class="container">
            <div class="row gx-0 gy-4">
                <div class="col-lg-3  wow fadeInUp" data-wow-delay="400ms">
                    <div class="widget footer-widget">
                        <div class="vs-widget-about-seven">
                            <div class="footer-logo"><img
                                    src="{{ asset('storage/' . settings('general', 'logo')->value) }}"
                                    alt="{{ settings('general', 'name')->value }}"></div>
                            <p class="footer-text">{{ settings('general', 'description')->value }}</p>
                            <ul class="footer-link-seven">
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3  wow fadeInUp" data-wow-delay="500ms">
                    <div class="widget v1 footer-widget widget_nav_menu-seven">
                        <h3 class="widget_title-seven">Department</h3>
                        <div class="menu-all-pages-container">
                            <ul class="menu-seven">
                                <li><a href="#">Cancer Services</a></li>
                                <li><a href="#">Heart Checkup</a></li>
                                <li><a href="#">Pathology Drag</a></li>
                                <li><a href="#">Family Physician</a></li>
                                <li><a href="#">Hematology Super</a></li>
                                <li><a href="#">Laboratory Drag</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3  wow fadeInUp" data-wow-delay="600ms">
                    <div class="widget v1 footer-widget shedule">
                        <h3 class="widget_title-seven">{{__('label.Contact Info')}}</h3>
                        <div class="vs-widget-contact-seven">
                            <div class="media-style7 v1">
                                <div class="media-icon-seven"><i class="fal fa-phone-alt"></i></div>
                                <div class="media-body-seven">
                                    <p class="media-text">{{settings('contact_us','location')->value}}</p>
                                </div>
                            </div>
                            <div class="media-style7">
                                <div class="media-icon-seven"><i class="fal fa-envelope"></i></div>
                                <div class="media-body-seven">
                                    <span class="media-label">{{settings('contact_us','email')->value}}</span>
                                </div>
                            </div>

                                <div class="media-style7">
                                <div class="media-icon-seven"><i class="fal fa-phone"></i></div>
                                <div class="media-body-seven">
                                    <span class="media-label">{{settings('contact_us','mobile')->value}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
              <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="700ms">
    <div class="widget v1 footer-widget widget-time-nav">
        <h3 class="widget_title-seven">{{ __('label.work_hours') }}</h3>
        <div class="menu-all-pages">
            <ul class="time-menu-seven list-unstyled">

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
                    <li class="d-flex justify-content-between">
                        <span>{{ $days[$value->date][$locale] ?? $value->date }}</span>
                        <span>{{ formatTime($value->time_in) }} - {{ formatTime($value->time_out) }}</span>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    <div class="copyright-wrap-seven">
        <div class="container">
            <div class="copyright-text">
                <p class="mb-0 text-center text-muted small">
                    <i class="fal fa-copyright me-1"></i>
                    {{ date('Y') }}
                    <a href="{{ route('home') }}" class="fw-semibold text-primary text-decoration-none">
                        {{ settings('general', 'name')->value }}
                    </a>.
                    {{ __('All rights reserved.') }}
                </p>

            </div>
        </div>
    </div>
</footer>
