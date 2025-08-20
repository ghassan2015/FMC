<div class="modal fade" id="kt_modal_view" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title">{{ __('label.city_data') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="view_name_ar" class="form-label">{{ __('label.name') }} (AR)
                            </label>
                        <input type="text" readonly class="form-control form-control-solid" id="view_name_ar" name="name_ar"
                        required>
                    </div>


                    <div class="col-md-6">
                        <label for="view_name_en" class="form-label">{{ __('label.name') }}(EN)
                            </label>
                        <input type="text" class="form-control form-control-solid" id="view_name_en" name="name_en"
                            required>
                    </div>

                </div>




                <div class="row mb-4">

                    <div class="col-md-6 ">
                        <div class="form-check form-check-custom form-check-solid">
                            <input class="form-check-input" readonly type="checkbox" id="is-active" value="1"
                                name="is_active">
                            <label class="form-check-label ms-2"
                                for="is-active">{{ __('label.stauts') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->

        </div>
    </div>
</div>
