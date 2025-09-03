<div class="modal fade" id="addMedicalTest" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-single-invoice" id="addInvoiceModalLabel">{{ __('label.medical_test_data') }}
                </h5>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <form class="needs-validation" id="my-form-medical_clinic_user" name="my-form-medical_clinic_user"
                action="{{ route('admin.medicalTestUsers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-5">


                        <div class="col-lg-12">
                            <label for="add_edit_medical_test_id"
                                class="form-label required">{{ __('label.medical_test') }}</label>
                            <select class="form-select form-select-solid" data-control="select2" name="medical_test_id"
                                id="add_edit_medical_test_id" required>
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($medicalTests as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach

                            </select>
                            <div class="medical_test_id error"></div>
                        </div>




                    </div>


                    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">

                    <input type="hidden" id="medical_id" name="medical_id">







                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <label for="add_edit_medical_test_status"
                                class="form-label required">{{ __('label.status') }}</label>
                            <select class="form-select form-select-solid" data-control="select2"
                                id="add_edit_medical_test_status" name="status" required>
                                <option value="">{{ __('label.selected') }}</option>

                                @foreach ($constants as $value)
                                    <option value="{{ $value->id }}">{{ $value->value_name }}</option>
                                @endforeach
                            </select>
                            <div class="status error"></div>

                        </div>




                        <div class="col-lg-6  ">
                            <label for="add_edit_photo" class="form-label ">{{ __('label.photo') }}</label>
                            <input type="file" accept="image/*" class="form-control" id="add_edit_photo"
                                name="photo">

                            <div class="mt-2">
                                <img id="photo_invoice_preview" src="" alt="preview" class="img-thumbnail"
                                    style="max-height: 150px; display: none;">
                            </div>
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
