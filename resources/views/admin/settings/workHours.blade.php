    @extends('admin.layouts.master')

    @section('title', __('label.settings'))
    @section('toolbarSubTitle', __('label.settings'))
    @section('toolbarPage', __('label.work_hours'))


    @section('content')

        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->

                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        @php
                            $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                        @endphp

                        <form id="work-hours-form" name="work-hours-form" action="{{ route('admin.settings.WorkHours') }}"
                            method="POST">
                            @csrf
                            @foreach ($days as $day)
                                <div class="row g-3 align-items-center mb-2">
                                    <!-- اسم اليوم -->
                                    <div class="col-md-4">
                                        <input type="hidden" name="date[{{ $day }}]" value="{{ $day }}">
                                        <input type="text" class="form-control bg-light fw-bold text-center"
                                            value="{{ __('label.' . $day) }}" disabled>
                                    </div>

                                    <!-- وقت البداية -->
                                    <div class="col-md-4">
                                        <input type="time" name="time_in[{{ $day }}]"
                                            class="form-control text-center"
                                            value="{{ old('time_in.' . $day, isset($workHours[$day]) ? \Carbon\Carbon::parse($workHours[$day]->time_in)->format('H:i') : '') }}">

                                        <div class="time_in_{{ $day }} error text-danger small mt-1"></div>
                                    </div>

                                    <!-- وقت النهاية -->
                                    <div class="col-md-4">
                                        <input type="time" name="time_out[{{ $day }}]"
                                            class="form-control text-center"
                                            value="{{ old('time_in.' . $day, isset($workHours[$day]) ? \Carbon\Carbon::parse($workHours[$day]->time_out)->format('H:i') : '') }}">
                                        <div class="time_out_{{ $day }} error text-danger small mt-1"></div>
                                    </div>
                                </div>
                                <hr class="my-2">
                            @endforeach

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary" id="submit-button">{{ __('label.submit') }}
                                </button>
                                <div id="spinner" class="spinner-border text-primary" role="status"
                                    style="display:none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        </div>

    @endsection

    @push('scripts')
        @include('admin.settings.js.general')
    @endpush
