@extends('front.layouts.master')

@section('content')

<!--==============================
    Breadcrumb Area
===============================-->
<div class="breadcumb-wrapper">
    <div class="parallax" data-parallax-image="{{ asset('assets/img/breadcurmb/breadcurmb-1-1.jpg') }}"></div>
    <div class="container z-index-common">
        <div class="breadcumb-content text-center">
            <h1 class="breadcumb-title">{{ $article->title }}</h1>
            <div class="breadcumb-menu-wrap mt-2">
                <i class="far fa-home-lg"></i>
                <ul class="breadcumb-menu d-inline-flex list-unstyled ms-2">
                    <li><a href="{{ route('home') }}">{{ __('label.main') }}</a></li>
                    <li class="active ms-2">{{ $article->title }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--==============================
    Blog Area
===============================-->
<section class="vs-blog-wrapper blog-details space-top space-md-bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="vs-blog blog-single shadow-sm p-4 rounded bg-white">

                    <!-- Blog Image -->
                    <div class="blog-img mb-4 text-center">
                        <img src="{{ $article->photo }}"
                             alt="{{ $article->title }}"
                             class="img-fluid rounded"
                             style="max-width: 100%; max-height: 500px; object-fit: cover;">
                    </div>

                    <!-- Blog Content -->
                    <div class="blog-content">

                        <!-- Blog Meta -->
                        <div class="blog-meta d-flex flex-wrap align-items-center mb-3 text-muted">
                            <span class="me-3 mb-1"><i class="fal fa-eye"></i> {{ $article->visit_count }}</span>
                            <span class="mb-1"><i class="fal fa-calendar"></i> {{ $article->created_at->format('d M, Y') }}</span>
                        </div>

                        <!-- Blog Title -->
                        <h2 class="blog-title h3 mb-4">{{ $article->title }}</h2>

                        <!-- Blog Description -->
                        <div class="blog-description">
                            {!! $article->description !!}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
