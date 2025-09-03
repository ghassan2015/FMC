<div class="modal fade" id="addDrugUser" tabindex="-1" aria-labelledby="addInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title my-single-invoice" id="addInvoiceModalLabel">{{ __('label.drug_data') }}
                </h5>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <form class="needs-validation" id="my-form-drug-user" name="my-form-drug-user"
                action="{{ route('admin.drugUsers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row mb-5">



                        <div class="col-md-6">
                            <label for="name" class="form-label required">{{ __('label.name') }}</label>
                            <input type="text" name="name" id="drug_name" value="{{ old('name') }}"
                                class="form-control" required>

                            <input type="hidden" name="user_id" id="drug_user_id" value="{{ $user->id }}"
                                class="form-control" required>
<input type="hidden" name="drug_id" id="drug_id"
                                class="form-control" required>
                            <div class="name error"></div>
                        </div>


                            <div class="col-md-6">
                            <label for="name" class="form-label required">{{ __('label.number_time_use') }}</label>
                            <input type="number" name="number_time_use" id="number_time_use" value="{{ old('number_time_use') }}"
                                class="form-control" required>


                            <div class="number_time_use error"></div>
                        </div>



                    </div>



                    <input type="hidden" id="drug_user_id" name="drug_user_id">








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
