@extends('front.layouts.master')

@section('content')
    <div class="breadcumb-wrapper ">
        <div class="parallax" data-parallax-image="{{ asset('assets/img/breadcurmb/breadcurmb-1-1.jpg') }}"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <div class="breadcumb-menu-wrap">
                    <i class="far fa-home-lg"></i>
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">{{ __('label.main') }}</a></li>
                        <li class="active">{{ __('label.articales') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="vs-team-wrapper space">
        <div class="container">
            <div class="row ">
                @foreach ($articles as $key => $article)
                    <div class="col-xl-4 wow fadeInUp" data-wow-delay="{{ 400 + $key * 100 }}ms">
                        <div class="vs-blog blog-card-seven shadow-sm rounded-3 overflow-hidden h-100">
                            <!-- Blog Image -->
                            <div class="blog-img-seven position-relative">
                                <img src="{{ $article->photo }}" alt="{{ $article->title }}"
                                style="width:350px;height: 350px;object-fit: contain; "
                                class="w-125  rounded-top">
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
            <div class="vs-pagination pt-lg-30">
                <ul>
                    {{-- Previous Page --}}
                    @if ($articles->onFirstPage())
                        <li><span><i class="fas fa-angle-left"></i></span></li>
                    @else
                        <li><a href="{{ $articles->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                        @if ($page == $articles->currentPage())
                            <li><a href="#" class="active">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach

                    {{-- Next Page --}}
                    @if ($articles->hasMorePages())
                        <li><a href="{{ $articles->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                    @else
                        <li><span><i class="fas fa-angle-right"></i></span></li>
                    @endif
                </ul>
            </div>

        </div>
    </section>

    @endsection
