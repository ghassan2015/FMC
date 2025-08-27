<div class="modal fade" id="kt_modal_add_edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">{{ __('label.medical_test_type_data') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="my-form" action="{{ route('admin.medicalTests.store') }}" method="post"
                enctype="multipart/form-data">


                @csrf
                <div class="modal-body">
                    <!-- Name and Email Fields -->
                    <input type="hidden" class="form-control form-control-solid" id="add_edit_medical_test_id" name="medical_test_id">

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="add_edit_name_ar" class="form-label">{{ __('label.name') }}(AR) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" id="add_edit_name_ar" name="name_ar"
                                required>

                                <div id="name_ar" class="error name_ar"></div>

                        </div>


                        <div class="col-md-6">
                            <label for="add_edit_name_en" class="form-label">{{ __('label.name') }} (EN) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" id="add_edit_name_en" name="name_en"
                                required>
                        </div>
                        <div id="name_en" class="error name_en"></div>


                    </div>




                    <div class="modal-footer">
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary" form="my-form">
                            <i class="ki ki-submit-duotone fs-2"></i>{{ __('label.submit') }}
                        </button>

                        <!-- Cancel Button -->
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="ki ki-times-duotone fs-2"></i> {{ __('label.cancel') }}
                        </button>

                        <!-- Spinner (hidden initially) -->
                        <div id="spinner" class="spinner-border text-primary" role="status"
                            style="display:none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

            </form>
        </div>
    </div>
</div>
