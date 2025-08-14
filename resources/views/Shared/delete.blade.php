<div class="modal fade" tabindex="-1" id="confirmModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ __('label.delete') }}</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">

                <form action="" id="delete" method="post">
                    @csrf
                    <h4>هل انت متاكد من عملية الحذف </h4>
                    <input type="hidden">
                    <input id="Delete_id" type="hidden" name="id" class="form-control">
                    <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                    <div class="modal-footer">
                        <a class="btn btn-danger submit submit_delete"><span><i class="fa fa-paper-plane px-3"
                                    aria-hidden="true"></i></span>تاكيد
                        </a>
                        <a type="button" class="btn btn-default px-3 " data-bs-dismiss="modal">
                            <i class="fa fa-window-close px-3" aria-hidden="true">الغاء</i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
