<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title status_user" id="exampleModalLabel">{{ __('label.status_user') }}</h1>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <form class="needs-validation" name="my-form" id="my-form" action="{{ route('admin.users.addToBranch') }}"
                method="post" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <!-- Date Input -->



                        <div class="col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label for="permanent_type "  class="form-label required">{{ __('label.user_type') }}

                                </label>

                                <select id="user_type_id" style="width: 100%" class="form-select form-select-solid"
                                    data-control="select2" name="user_type_cd_id" required>
                                    <option value="">{{ __('label.selected') }}</option>
                                    @foreach ($userTypes as $value)
                                        <option value="{{ $value->id }}">
                                            {{ $value->value }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-12">
                            <label for="status"  class="form-label required">
                                {{ __('label.status') }}
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" name="status"
                                id="add_status" style="width: 100%">
                                <option value="">{{ __('label.select') }}</option>
                                <option value="1">{{ __('label.users_inside_hub_menu') }}</option>
                                <option value="3">{{ __('label.users_no_hub_menu') }}</option>
                                <option value="0">{{ __('label.users_not_avtive') }}</option>

                            </select>
                        </div>
                        <div class="col-lg-4 col-sm-12 branch_id " style="display: none">
                            <label for="branch_id">
                                {{ __('label.branches') }}
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" name="branch_id"
                                id="add_branch_id" style="width: 100%">
                                <option value="">{{ __('label.select') }}</option>

                                @foreach ($branches as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-sm-12  branch_id " style="display: none">
                            <label for="work_space_id" class="form-label required">
                                {{ __('label.work_space') }}
                            </label>
                            <select class="form-select form-select-solid" data-control="select2" name="work_space_id"
                                id="add_work_space" style="width: 100%">
                                <option value="">{{ __('label.select') }}</option>


                            </select>
                        </div>


                        <div class="col-lg-4 col-sm-12  branch_id " style="display: none">
                            <label for="work_space_id"  class="form-label required">
                                {{ __('label.desk_mangments') }}
                            </label>
                            <select class="form-select form-select-solid branch_id" data-control="select2" branch_id"
                                name="desk_mangment_id" id="desk_mangment_id" style="width: 100%">
                                <option value="">{{ __('label.select') }}</option>


                            </select>
                        </div>

                        <input type="hidden" id="add_user_branch_id" name="user_id" class="add_user_branch_id">

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" id="send_form" class="btn btn-primary">
                        <i class="fa fa-paper-plane hiden_icon" aria-hidden="true"></i>
                        <span id="spinner" style="display: none;">
                            <i class="fa fa-spinner fa-spin" style="font-size: 16px;"></i>
                        </span>
                        {{ __('label.submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-window-close" aria-hidden="true"></i>
                        {{ __('label.cancel') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
