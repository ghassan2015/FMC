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
                        <li class="active">{{ __('label.videoes') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="vs-team-wrapper space">
        <div class="container">
            <div class="row">
    <div class="row">
    @foreach ($videoes as $value)
        <div class="col-md-6 col-xl-4 mb-30 wow fadeInUp" data-wow-delay="0.3s">
            <div class="team-card shadow-sm rounded-3 overflow-hidden">
                <!-- صورة الفيديو + أيقونة التشغيل -->
                <div class="team-head position-relative">
                    <img src="{{ $value->thumbnail }}" alt="{{ $value->title }}" class="w-100 img-fluid rounded-top">
                    <a href="{{ $value->url }}" class="play-btn popup-video style3 position-absolute top-50 start-50 translate-middle">
                        <i class="fas fa-play"></i>
                    </a>
                </div>

                <!-- معلومات الفيديو -->
                <div class="team-body p-3">
                    <h3 class="h5 mb-2">
                        <a href="{{ $value->url }}" target="_blank" class="text-reset fw-bold">
                            {{ $value->title }}
                        </a>
                    </h3>
                    <p class="fs-sm text-muted mb-0">
                        {{ \Illuminate\Support\Str::words($value->description, 20, '...') }}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

        </div>

        <div class="vs-pagination pt-lg-30">
            <ul>
                {{-- Previous Page --}}
                @if ($videoes->onFirstPage())
                    <li><span><i class="fas fa-angle-left"></i></span></li>
                @else
                    <li><a href="{{ $videoes->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                @endif

                {{-- Page Numbers --}}
                @foreach ($videoes->getUrlRange(1, $videoes->lastPage()) as $page => $url)
                    @if ($page == $videoes->currentPage())
                        <li><a href="#" class="active">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                {{-- Next Page --}}
                @if ($videoes->hasMorePages())
                    <li><a href="{{ $videoes->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                @else
                    <li><span><i class="fas fa-angle-right"></i></span></li>
                @endif
            </ul>
        </div>

        </div>
    </section>
@endsection
