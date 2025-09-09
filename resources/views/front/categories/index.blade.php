@extends('front.layouts.master')

@section('content')
    <!-- ====== Breadcumb ====== -->
    <div class="breadcumb-wrapper">
        <div class="parallax" data-parallax-image="{{ asset('assets/img/breadcurmb/breadcurmb-1-1.jpg') }}"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content text-center text-white">
                <h1 class="breadcumb-title">{{ $category->name }}</h1>
                <div class="breadcumb-menu-wrap">
                    <i class="far fa-home-lg"></i>
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">{{ __('label.main') }}</a></li>
                        <li><a href="{{ route('front.categories.index') }}">{{ __('label.categories') }}</a></li>
                        <li class="active">{{ $category->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Category Details ====== -->
    <section class="vs-details-wrapper space-top space-md-bottom">
        <div class="container">
            <div class="row g-4">
                <!-- الصورة الرئيسية -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 rounded-3">
                        <img src="{{ asset($category->photo) }}" class="card-img-top rounded-top" alt="category photo"
                            style="height: 350px; object-fit: cover;">

                        <div class="card-body text-center">

                            <h4 class="mt-3">{{ $category->name }}</h4>
                        </div>
                    </div>
                </div>

                <!-- التفاصيل -->
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <h5 class="mb-3 text-primary">{{ __('label.description') }}</h5>
                            <div class="mb-3">
                                {!! $category->description ?? '' !!}
                            </div>

                            <!-- Tabs -->
                            <ul class="nav nav-pills mb-3" id="categoryTabs" role="tablist">
                                @if ($category->categoryBeforeSurgicalOperations)
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                            href="#before">{{ __('label.before_operation') }}</a></li>
                                @endif

                                @if ($category->categoryAferSurgicalOperations)
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#after">{{ __('label.after_operation') }}</a></li>
                                @endif
                                @if ($category->video)
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#video">{{ __('label.video') }}</a></li>
                                @endif
                            </ul>

                            <div class="tab-content">
                                <!-- صور قبل العملية -->
                                <div class="tab-pane fade show active" id="before">
                                    <div class="row g-2">
                                        @forelse($category->categoryBeforeSurgicalOperations as $before)
                                            <div class="col-6">
                                                <img src="{{ asset('uploads/' . $before->photo) }}"
                                                    class="img-fluid rounded shadow-sm" alt="before photo">
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('label.no_data') }}</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- صور بعد العملية -->
                                <div class="tab-pane fade" id="after">
                                    <div class="row g-2">
                                        @forelse($category->categoryAferSurgicalOperations as $after)
                                            <div class="col-6">
                                                <img src="{{ asset('uploads/' . $after->photo) }}"
                                                    class="img-fluid rounded shadow-sm" alt="after photo">
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('label.no_data') }}</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- فيديو -->
                                @if ($category->video)
                                    <div class="tab-pane fade" id="video">
                                        <div class="ratio ratio-16x9">
                                            <iframe src="{{ $category->video }}" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($category->childCategories && $category->childCategories->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h4 class="mb-3">{{ __('label.subcategories') }}</h4>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($category->childCategories as $child)
                                <a href="{{ route('front.categories.index', $child->id) }}"
                                    class="btn btn-outline-primary rounded-pill px-4 py-2">
                                    {{ $child->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- معلومات إضافية -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="accordion shadow-sm" id="extraInfo">
                        @if ($category->reason)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingReason">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseReason">
                                        {{ __('label.reason') }}
                                    </button>
                                </h2>
                                <div id="collapseReason" class="accordion-collapse collapse show"
                                    data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->reason !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->disease_type)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDisease">
                                        {{ __('label.disease_type') }}
                                    </button>
                                </h2>
                                <div id="collapseDisease" class="accordion-collapse collapse" data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->disease_type !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->surgery_therapy)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTherapy">
                                        {{ __('label.surgery_therapy') }}
                                    </button>
                                </h2>
                                <div id="collapseTherapy" class="accordion-collapse collapse"
                                    data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->surgery_therapy !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->surgery_type)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapseType">
                                        {{ __('label.surgery_type') }}
                                    </button>
                                </h2>
                                <div id="collapseType" class="accordion-collapse collapse" data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->surgery_type !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->preparing_operation)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePrepare">
                                        {{ __('label.preparing_operation') }}
                                    </button>
                                </h2>
                                <div id="collapsePrepare" class="accordion-collapse collapse"
                                    data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->preparing_operation !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->payment_type)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePayment">
                                        {{ __('label.payment_type') }}
                                    </button>
                                </h2>
                                <div id="collapsePayment" class="accordion-collapse collapse"
                                    data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{!! $category->payment_type !!}</div>
                                </div>
                            </div>
                        @endif

                        @if ($category->operation_pirce)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#collapsePrice">
                                        {{ __('label.operation_price') }}
                                    </button>
                                </h2>
                                <div id="collapsePrice" class="accordion-collapse collapse" data-bs-parent="#extraInfo">
                                    <div class="accordion-body">{{ $category->operation_pirce }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- الأقسام التابعة له -->
            @if ($category->children && $category->children->count() > 0)
                <div class="row mt-5">
                    <div class="col-12">
                        <h4>{{ __('label.subcategories') }}</h4>
                        <div class="row g-3">
                            @foreach ($category->children as $child)
                                <div class="col-md-4">
                                    <div class="card h-100 shadow-sm border-0">
                                        <img src="{{ asset($child->photo) }}" class="card-img-top"
                                            alt="subcategory photo">
                                        <div class="card-body text-center">
                                            <h6>{{ $child->name }}</h6>
                                            <a href="{{ route('front.categories.index', $child->id) }}"
                                                class="btn btn-outline-primary btn-sm mt-2">
                                                {{ __('label.view_details') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
