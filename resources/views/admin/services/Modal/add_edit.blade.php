<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ __('label.service_data') }}</h6>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <!-- Form -->
            <form class="needs-validation" id="my-form" novalidate method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="service_id" name="service_id">

                <div class="modal-body">

                    <!-- Logo Upload -->


                    <!-- Branch Name -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required" for="name_ar">{{ __('label.name') }} (AR)</label>
                            <input type="text" name="name_ar" class="form-control" id="name_ar" required>
                            <div class="name_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required" for="name_en">{{ __('label.name') }} (EN)</label>
                            <input type="text" name="name_en" class="form-control" id="name_en" required>
                            <div class="name_en error"></div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required" for="description_ar">{{ __('label.description') }}
                                (AR)</label>
                            <textarea name="description_ar" class="form-control" id="description_ar" required></textarea>
                            <div class="description_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required" for="description_en">{{ __('label.description') }}
                                (EN)</label>
                            <textarea name="description_en" class="form-control" id="description_en" required></textarea>

                            <div class="description_en error"></div>
                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col-md-6 ">
                            <label class="form-label fw-semibold fs-6">{{ __('label.logo') }}</label>
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}'); margin: auto;">

                                <div class="image-input-wrapper w-125px h-125px" id="logoPreview"
                                    style="background-image: url('{{ asset('assets/default.png') }}');"></div>

                                <!-- Change -->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    title="{{ __('label.change_avatar') }}">
                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg, .webp" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>

                                <!-- Cancel -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 start-0 translate-middle"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                    title="{{ __('label.cancel_avatar') }}">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>

                                <!-- Remove -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                    title="{{ __('label.remove_avatar') }}">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>

                                <div class="avatar error"></div>

                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle"></i> {{ __('label.allowed_file_types') }}: jpg, png,
                                jpeg,
                                webp
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold fs-6">{{ __('label.logo_icon') }}</label>
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}'); margin: auto;">

                                <div class="image-input-wrapper w-125px h-125px" id="iconPreview"
                                    style="background-image: url('{{ asset('assets/default.png') }}');">
                                </div>

                                <!-- Change -->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    title="{{ __('label.change_avatar') }}">
                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <input type="file" name="logo_icon" accept=".png, .jpg, .jpeg, .webp" />
                                    <input type="hidden" name="logo_icon_remove" />
                                </label>

                                <!-- Cancel -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 start-0 translate-middle"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                    title="{{ __('label.cancel_avatar') }}">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>

                                <!-- Remove -->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                    title="{{ __('label.remove_avatar') }}">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>

                                <div class="logo_icon error"></div>

                            </div>
                            <div class="form-text mt-2">
                                <i class="fas fa-info-circle"></i> {{ __('label.allowed_file_types') }}: jpg, png,
                                jpeg, webp
                            </div>
                        </div>

                    </div>




                    <!-- Working Hours -->

                    <!-- Status -->
                    <div class="row mb-5">
                        <div class="col-md-12">
                            <label class="form-label">{{ __('label.status') }}</label>
                            <label class="form-switch">
                                <input class="form-check-input" name="is_active" id="is_active" value="1"
                                    type="checkbox" checked>
                                <span class="form-check-label"></span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane hiden_icon"></i>
                        <span id="spinner" style="display: none;"><i class="fa fa-spinner fa-spin"
                                style="font-size:24px"></i></span>
                        {{ __('label.submit') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa fa-window-close"></i> {{ __('label.cancel') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
