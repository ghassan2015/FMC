<!--begin::Search-->
<div class="d-flex flex-column flex-md-row flex-stack mb-5 gap-3">
    <div class="d-flex align-items-center position-relative my-1 flex-grow-1 search_invoice search_block">
        <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6"><span class="path1"></span><span
                class="path2"></span></i>
        <input type="text" data-kt-docs-table-filter="search_appointment"
            class="form-control form-control-solid w-100 ps-15" placeholder="{{ __('label.search_placeholder') }}" />
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-end gap-2" data-kt-docs-table-toolbar="base">
        <button type="button" class="btn btn-light-primary me-0 me-sm-3" onclick="toggleAppointmentsFilter()">
            <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
            {{ __('label.filter') }}
        </button>


        <a class="btn btn-primary add_appointment" data-bs-toggle="tooltip"
            title="{{ __('label.add_new_appointment') }}">
            <i class="ki-duotone ki-plus fs-2"></i>
            {{ __('label.add_new_appointment') }}
        </a>
    </div>
</div>

<!-- Counters -->
<div class="row mb-4">
    <div class="col-lg-3 col-sm-6">
        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-wallet fs-1 text-warning me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.appointment_count') }}</label>
                    <div id="appointment_count" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>

       <div class="col-lg-3 col-sm-6">
        <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-credit-cart fs-1 text-success me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.appointment_month_count') }}</label>
                    <div id="appointment_month_count" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6">
        <div class="col bg-light-success px-6 py-8 rounded-2 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-credit-cart fs-1 text-success me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.appointment_day_count') }}</label>
                    <div id="appointment_day_count" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-3 col-sm-6">
        <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
            <div class="d-flex align-items-center">
                <i class="ki-outline ki-check-circle fs-1 text-warning me-3"></i>
                <div>
                    <label class="fw-bold">{{ __('label.appointment_pendding_count') }}</label>
                    <div id="appointment_pendding_count" class="fw-bolder fs-4 text-dark"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div id="filter-appointment-section" class="row mb-5 d-none align-items-end">
    <div class="row mb-4">

        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.doctors') }}</label>
            <select class="form-select form-select-solid" data-control="select2" id="search_doctor_id">
                <option value="">{{ __('label.all_doctors') }}</option>

                @foreach ($doctors as $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.start_date') }}</label>
            <input type="text" class="form-control kt_datepicker" readonly id="search_appointment_start_date" />
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.end_date') }}</label>
            <input type="text" class="form-control kt_datepicker" readonly id="search_appointment_end_date" />
        </div>
        <div class="col-lg-3 col-sm-12 mb-3">
            <label class="form-label fw-bold">{{ __('label.status') }}</label>
            <select class="form-select form-select-solid" data-control="select2" id="search_appointment_status">
                <option value="">{{ __('label.all_statues') }}</option>

                @foreach ($appointmentStatuses as $value)
                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<!-- Hidden user id -->
<input type="hidden" id="appointment_user_id" value="{{ isset($user) ? optional($user)->id : '' }}">

<!-- Table -->
<table id="appointment_table" class="table align-middle table-row-dashed fs-6 gy-5">
    <thead>
        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
            <th></th>
            <th>{{ __('label.name') }}</th>
            <th>{{ __('label.doctor_name') }}</th>
            <th>{{ __('label.date') }}</th>
            <th>{{ __('label.time') }}</th>
            <th>{{ __('label.payment_type') }}</th>
            <th>{{ __('label.payment_status') }}</th>
            <th>{{ __('label.status') }}</th>
            <th>{{ __('label.actions') }}</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@include('components.appointments.add_edit')

@include('components.appointments.script.index')
