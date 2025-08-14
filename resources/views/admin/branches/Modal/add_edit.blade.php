<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('label.branch_data') }}</h1>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
            </div>

            <form class="needs-validation" id="my-form" novalidate method="post">

                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="branch_id" name="branch_id">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.name') }}</label>

                            <input type="text" name="name" class="form-control" id="name"
                                aria-describedby="emailHelp" placeholder="" required>
                            <div class="name_ar">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required">{{ __('label.code') }}</label>

                            <input type="text" name="code" class="form-control" id="code"
                                aria-describedby="emailHelp" placeholder="" required>
                            <div class="code">

                            </div>
                        </div>





                    </div>



                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label class="form-label ">{{ __('label.status') }}</label>

                            <label class="form-switch">
                                <input class="form-check-input" name="status" id="status" type="checkbox" checked
                                    <span class="form-check-label"></span>
                            </label>

                        </div>
                    </div>





                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span>
                                <i class="fa fa-paper-plane hiden_icon" aria-hidden="true">
                                </i>
                                <span id="spinner" style="display: none;">
                                    <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                                </span>
                                {{ __('label.submit') }}


                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true"></i>
                            {{ __('label.cancel') }}
                        </button>

                    </div>
            </form>
        </div>
    </div>
</div>
