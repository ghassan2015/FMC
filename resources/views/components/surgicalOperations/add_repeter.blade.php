<div class="modal fade" id="addMedicalTest" tabindex="-1" aria-labelledby="addMedicalTestLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMedicalTestLabel">{{ __('label.medical_test_data') }}
                </h5>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <form class="needs-validation" id="my-form-medical_clinic_user" name="my-form-medical_clinic_user"
                action="{{ route('admin.medicalTestUsers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="kt_docs_repeater_basic">
                    <!-- Repeater List -->
                    <div data-repeater-list="y">
                        <!-- Repeater Item -->
                        <div data-repeater-item class="mb-4 p-3 border rounded">

                            <div class="row">

                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <!-- Medical Test -->
                                <div class="col-lg-4">
                                    <label class="form-label required">{{__('label.medical_test')}}</label>
                                    <select class="form-select medical_test_select" data-kt-repeater="select2"
                                        name="medical_test_id" required>
                                        <option value="">{{__('label.selected')}}</option>
                                        @foreach ($medicalTests as $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <!-- Delete Button -->
                                <div class="col-lg-1 d-flex align-items-end">
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                        {{__('label.delete')}}
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Add Button -->
                    <div class="mt-3">
                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                            {{__('label.add')}}
                        </a>
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
