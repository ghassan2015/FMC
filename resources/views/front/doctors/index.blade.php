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
                        <li class="active">{{ __('label.Our Doctors') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                Team Area
                ==============================-->
    <section class="vs-team-wrapper space">
        <div class="container">
            <div class="row ">
                @foreach ($doctors as $value)
                    <div class="col-md-6 col-xl-4 mb-30 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-card">
                            <div class="team-head">
                                <img src="{{ $value->admin?->getAttachment() }}"
                                style="width:350px;height: 350px;object-fit: cover" alt="{{ $value->admin?->name }}"
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
                                    <p class="fs-xs team-info"><i class="fas fa-phone text-theme"></i><a class="text-reset"
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
            <div class="vs-pagination pt-lg-30">
                <ul>
                    {{-- Previous Page --}}
                    @if ($doctors->onFirstPage())
                        <li><span><i class="fas fa-angle-left"></i></span></li>
                    @else
                        <li><a href="{{ $doctors->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($doctors->getUrlRange(1, $doctors->lastPage()) as $page => $url)
                        @if ($page == $doctors->currentPage())
                            <li><a href="#" class="active">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($doctors->hasMorePages())
                        <li><a href="{{ $doctors->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                    @else
                        <li><span><i class="fas fa-angle-right"></i></span></li>
                    @endif
                </ul>
            </div>

        </div>
    </section>
@endsection
