@extends('front.layouts.master')

@section('content')
    <div class="breadcumb-wrapper ">
        <div class="parallax" data-parallax-image="assets/img/breadcurmb/breadcurmb-1-1.jpg"></div>
        <div class="container z-index-common">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">{{ $doctor->name }}</h1>
                <div class="breadcumb-menu-wrap">
                    <i class="far fa-home-lg"></i>
                    <ul class="breadcumb-menu">
                        <li><a href="{{ route('home') }}">{{ __('label.main') }}</a></li>
                        <li class="active">{{ __('label.Doctors Details') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--==============================
                                Team Details
                                ==============================-->
    <section class="vs-details-wrapper space-top space-md-bottom">
        <div class="container">
            <div class="row gx-40">
                <div class="col-lg-5">

                    <div class="member-header mb-40 overflow-hidden rounded-3 position-relative">
                        <div class="member-details-img">
                            <img src="{{ $doctor->admin?->getAttachment() }}" alt="Member Image" class="w-100">
                        </div>

                        <div class="member-angle-links">
                            <span class="middle-icon"><i class="fas fa-share-alt"></i></span>
                            <a href="{{ $doctor->facebook }}"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ $doctor->instagram }}"><i class="fab fa-instagram"></i></a>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $doctor->whatsapp) }}" target="_blank"> <i
                                    class="fab fa-whatsapp"></i></a>
                        </div>



                    </div>

                    <div class="team-schedule bg-smoke wow fadeInUp" data-wow-delay="0.3s">
                        <h3 class="h4 border-title">{{ __('label.work_hours') }}</h3>
                        <table class="team-schedule-table">
                            <tbody>

                                @php
                             
                                    $days = [
                                        'Saturday' => 'السبت',
                                        'Sunday' => 'الأحد',
                                        'Monday' => 'الاثنين',
                                        'Tuesday' => 'الثلاثاء',
                                        'Wednesday' => 'الأربعاء',
                                        'Thursday' => 'الخميس',
                                        'Friday' => 'الجمعة',
                                    ];
                                @endphp

                                @foreach ($doctor->schedules as $value)
                                    <tr>
                                        <td>{{ $days[$value->day] ?? $value->day }}</td>
                                        <td>{{ formatTime($value->start_time) }} -
                                            {{ formatTime($value->end_time) }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <a href="tel:66925682596" class="vs-btn style2">(669) 2568 2596<i class="fas fa-phone"></i></a>
                    </div>

                </div>
                <div class="col-lg-7">
                    <div class="team-content">
                        <h2 class="mb-0 mt-n2">{{ $doctor->name }}</h2>
                        <p class="text-theme fs-xs">{{ $doctor->specializations?->name }}</p>
                        <p class="fs-md text-title"></p>
                        <table class="member-table">
                            <tbody>
                                <tr>
                                    <th><strong>{{ __('label.description') }}</strong></th>
                                    <td>{{ $doctor->about_us }}</td>
                                </tr>

                            </tbody>
                        </table>

                        <form action="{{ route('front.appointments.store') }}" method="POST"
                            class="form-wrap1 shadow-none mb-30 rounded-3 overflow-hidden wow fadeInUp"
                            id="my-form-apointment" name="my-form-apointment" data-wow-delay="0.3s data-bg-color="#f3f6f7"">

                            <div class="form-title-box bg-title" data-bg-src="assets/img/bg/bg-shape-9.jpg">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-xl-10">
                                        <<h2 class="h4 mb-2 text-white">
                                            {{ __('label.book_now') }}
                                            </h2>
                                            <p class="mb-0 text-white-light">
                                                {{ __('label.book_desc') }}
                                            </p>
                                    </div>

                                </div>
                            </div>
                            <div class="form-box">
                                <div class="row">
                                    <div class="col-xl-6 form-group">
                                        <input type="text" name="name" required class="form-control  style2"
                                            placeholder="{{ __('label.name') }}">
                                        <i class="fal small fa-user"></i>
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <input type="email" name="email" required class="form-control  style2"
                                            placeholder="{{ __('label.email') }}">
                                        <i class="fal small fa-envelope"></i>
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <input type="number" name="mobile" required class="form-control  style2"
                                            placeholder="{{ __('label.mobile') }}">
                                        <i class="fal small fa-phone"></i>
                                    </div>


                                    <div class="col-xl-6 form-group">
                                        <input type="text" class="form-control  style2" name="id_number" required
                                            placeholder="{{ __('label.id_number') }}">
                                    </div>
                                    <div class="col-xl-6 form-group">
                                        <select class="form-select style2" id="AppointmentBranch" name="branch_id" required>


                                            <option disabled selected>{{ __('label.display_all_branches') }}</option>

                                            @foreach ($branches as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" id="doctorAppointment" name="doctor_id"
                                        value="{{ $doctor->id }}">
                                    <div class="col-xl-6 form-group">
                                        <input type="text" class="date-pick form-control  style2" name="date" required
                                            id="appointmentDate" placeholder="{{ __('label.select_date') }}">
                                        <i class="fal small fa-calendar-alt"></i>
                                    </div>



                                    <div class="" id="availableTimes"></div>


                                </div>
                                <div class="col-xl-12 text-center">
                                    <button type="submit"id="submit-button"
                                        class="vs-btn style2">{{ __('label.make_appointment') }}<i
                                            class="far fa-calendar-alt"></i>

                                        <span id="spinner" style="display:none;">
                                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
