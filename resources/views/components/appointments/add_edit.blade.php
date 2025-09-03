<style>
    /* تحسين الشكل */
#availableTimes .time-btn {
    min-width: 90px;
    padding: 0.4rem 0.8rem;
    border-radius: 0.5rem;
    transition: all 0.2s;
}

#availableTimes .time-btn:hover {
    transform: scale(1.05);
}

    </style>
<div class="modal fade" id="appointmentModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('label.add_appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="my-form-apointment" name="my-form-apointment" action="{{ route('admin.appointments.store') }}"
                method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf

                <div class="modal-body">
                    <!-- hidden inputs -->
                    <input type="hidden" id="appointment_id" name="appointment_id">
                    <input type="hidden" id="selectedTime" name="time">


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.users') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="userSelect"
                                name="user_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                <option value="new">{{ __('label.add_new_user') }}</option>
                                @foreach ($users as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.branch') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="AppointmentBranch"
                                name="branch_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>

                    <!-- New User Fields -->
                    <div class="row g-3 d-none new_user">
                        <div class="col-md-6">
                            <label for="name" class="form-label required">{{ __('label.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label required">{{ __('label.email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="mobile" class="form-label required">{{ __('label.mobile') }}</label>
                            <input type="tel" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="id_number" class="form-label">{{ __('label.id_number') }}</label>
                            <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}"
                                class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="birth_date" class="form-label">{{ __('label.birth_date') }}</label>
                            <input type="text" name="birth_date kt_datepicker" id="birth_date" value="{{ old('birth_date') }}"
                                class="form-control birth_date">
                        </div>
                    </div>

                    <!-- Date & Appointment Time -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.doctors') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="doctorAppointment"
                                name="doctor_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.date') }}</label>
                            <input type="text" class="form-control kt_datepicker" readonly name="date"
                                id="appointmentDate" required>

                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label required">{{ __('label.appointments') }}</label>
                            <div id="availableTimes" class="d-flex flex-wrap gap-2 mt-2"
                                style="min-height: 50px; align-items: center;"></div>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label required">{{ __('label.payment_type') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="payment_type_id"
                                name="payment_type_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($paymentTypes as $value)
                                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-md-4">
                            <label class="form-label required">{{ __('label.payment_status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="is_paid"
                                name="is_paid" required>
                                <option value="">{{ __('label.selected') }}</option>

                                <option value="0">{{ __('label.not_paid') }}</option>
                                <option value="1">{{ __('label.paid') }}</option>
                            </select>
                        </div>


                                <div class="col-md-4">
                            <label class="form-label required">{{ __('label.status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="appointment_status_id"
                                name="appointment_status_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($appointmentStatuses as $value)
                                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane hiden_icon"></i>
                        <span id="spinner" style="display:none;">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        </span>
                        {{ __('label.submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-window-close"></i> {{ __('label.cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
