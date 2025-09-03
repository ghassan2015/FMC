<div class="modal fade" id="addSurgicalOperation" tabindex="-1" aria-labelledby="addSurgicalOperationLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title " id="addSurgicalOperationLabel">
                    {{ __('label.surgical_operation_data') }}
                </h5>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <form class="needs-validation" id="my-form-surgical_operation_user" name="my-form-surgical_operation_user"
                action="{{ route('admin.surgicalOperations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-5">


                        <div class="col-lg-6">
                            <label for="add_edit_surgical_operation_title"
                                class="form-label required">{{ __('label.title') }}</label>
                            <input type="text" class="form-control" name="title"
                                id="add_edit_surgical_operation_title">
                            <div class="title error"></div>
                        </div>


                        <div class="col-lg-6">
                            <label for="add_edit_surgical_operation_branch_id"
                                class="form-label required">{{ __('label.branches') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                id="add_edit_surgical_operation_branch_id" name="branch_id" required>
                                <option value="">{{ __('label.selected') }}</option>
                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach

                            </select>
                            <div class="branch_id error"></div>

                        </div>

                    </div>

                    <div class="row mb-5">

                        <div class="col-lg-6">
                            <label for="add_edit_surgical_operation_doctor_id"
                                class="form-label required">{{ __('label.doctor') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                id="add_edit_surgical_operation_doctor_id" name="doctor_id" required>
                                <option value="">{{ __('label.selected') }}</option>


                            </select>
                            <div class="doctor_id error"></div>

                        </div>



                        <div class="col-lg-6">
                            <label for="add_edit_surgical_operation_status"
                                class="form-label required">{{ __('label.status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                id="add_edit_surgical_operation_status" name="status" required>
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($constants as $value)
                                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                                @endforeach
                            </select>
                            <div class="status error"></div>

                        </div>






                    </div>




                    <input type="hidden" id="add_edit_surgical_operation_user_id" name="user_id"
                        value="{{ $user->id }}">

                    <input type="hidden" id="add_edit_surgical_operation_id" name="surgical_operation_id">

                    <div class="row mb-5">


                        <div class="col-lg-12">
                            <label for="add_edit_surgical_operation_description"
                                class="form-label required">{{ __('label.description') }}</label>
                            <textarea class="form-control" name="description" id="add_edit_surgical_operation_description">
                          </textarea>
                            <div class="description error"></div>
                        </div>

                    </div>







                    <div class="row mb-5">

                        <div class="col-md-6">
                            <label for="add_edit_surgical_operation_date"
                                class="form-label">{{ __('label.date') }}</label>
                            <input type="text" name="date" class="form-control kt_datepicker"
                                id="add_edit_surgical_operation_date" value="{{ old('date') }}"
                                class="form-control date">
                            <div class="date error"></div>

                        </div>



                        <div class="col-md-6">
                            <label for="add_edit_surgical_operation_time"
                                class="form-label">{{ __('label.time') }}</label>
                            <input type="time" name="time" class="form-control"
                                id="add_edit_surgical_operation_time" value="{{ old('time') }}">
                            <div class="time error"></div>

                        </div>
                    </div>

                    <div class="row mb-5">


                        <div class="col-lg-12">
                            <label for="add_edit_surgical_operation_note"
                                class="form-label ">{{ __('label.note') }}</label>
                            <textarea class="form-control" name="note" id="add_edit_surgical_operation_note">
                          </textarea>
                            <div class="note error"></div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i> {{ __('label.submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('label.close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
