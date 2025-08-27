<div class="modal fade" id="appointmentModal" tabindex="-1">
    <div class="modal-dialog modal-xl"> <!-- هنا تم إضافة modal-xl -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('label.add_appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form class="needs-validation" id="my-form-apointment" name="my-form-apointment"
                action="{{ route('admin.appointments.store') }}"" novalidate method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="doctorId" name="doctor_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.users') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="userSelect"
                                name="user_id" required>
                                <option value="">{{ __('label.seleted') }}</option>

                                <option value="new">{{ __('label.add_new_user') }}</option>
                                @foreach ($users as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.doctors') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="doctor_appointment"
                                name="user_id" required>
                                <option value="">{{ __('label.seleted') }}</option>

                                @foreach ($doctors as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="row g-3 d-none new_user">
                        <!-- الاسم -->
                        <div class="col-md-6">
                            <label for="name" class="form-label required">{{ __('label.name') }}</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="col-md-6">
                            <label for="email" class="form-label required">{{ __('label.email') }}</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="form-control" required>

                        </div>

                        <!-- الجوال -->
                        <div class="col-md-6">
                            <label for="mobile" class="form-label required">{{ __('label.mobile') }}</label>
                            <input type="tel" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                class="form-control" required>

                        </div>

                        <!-- رقم الهوية -->
                        <div class="col-md-6">
                            <label for="id_number" class="form-label required">{{ __('label.id_number') }}</label>
                            <input type="text" name="id_number" id="id_number" value="{{ old('id_number') }}"
                                class="form-control ">

                        </div>

                        <!-- تاريخ الميلاد -->
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label required">{{ __('label.birth_date') }}</label>
                            <input type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                class="form-control kt_datepicker ">

                        </div>
                    </div>


                    <input type="hidden" id="selectedTime" name="time">


                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.branch') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="branchSelect"
                                name="branch_id" required>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.date') }}</label>
                            <input type="text" class="form-control kt_datepicker" readonly name="appointmentDate"
                                id="appointmentDate" placeholder="" required />
                        </div>

                    </div>
                    <div class="row mb-3">


                        <label class="form-label required">{{ __('label.appointments') }}</label>
                        <div id="availableTimes" class="d-flex flex-wrap gap-2"
                            style="min-height: 50px; align-items: center;"></div>
                    </div>
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.payment_type') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="payment_type_id"
                                name="payment_type_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($paymentTypes as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.payment_status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" id="is_paid"
                                name="is_paid" required>
                                <option value="0">{{ __('label.not_paid') }}</option>
                                <option value="1">{{ __('label.paid') }}</option>


                            </select>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane hiden_icon"></i>
                        <span id="spinner" style="display: none;"><i class="fa fa-spinner fa-spin"
                                style="font-size:24px"></i></span>
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
