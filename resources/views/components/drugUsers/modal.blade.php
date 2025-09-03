<div class="modal fade" id="InvoiceModal" style="max-height: 80vh; overflow-y: auto;" tabindex="-1" aria-labelledby="InvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InvoiceModalLabel">{{__('label.invocie_data')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body" >
                @include('components.invoice.table')
            </div>
        </div>
    </div>
</div>

