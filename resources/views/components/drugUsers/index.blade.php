
   <div class="modal fade" id="medsdfjkl;Modal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="invoiceModalLabel">{{ __('label.invoice_data') }}</h5>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                @include('components.medicalTests.table')
            </div>

        </div>
    </div>
</div>

