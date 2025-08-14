<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title add-service" id="addServiceModalLabel">{{ __('label.add_service') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addServiceForm" action="{{ route('admin.users.addService') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!-- حقل الخدمات -->
                        <div class="col-md-6 mb-3">
                            <label for="add_edit_service_id" class="form-label">{{ __('label.services') }}
                                <span class="error">*</span>
                            </label>
                            <select class="form-control"   data-control="select2" name="service_id" id="add_edit_service_id" required>

                            </select>
                            <div id="loadingService" style="display:none;">
  جاري التحميل...
</div>
                        </div>



                        <input type="hidden" class="form-control" id="add_edit_service_user_id" name="user_id" required>
                    </div>





                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('label.submit') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('label.close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

