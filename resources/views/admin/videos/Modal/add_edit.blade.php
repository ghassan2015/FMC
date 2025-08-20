<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalModalLabel">{{ __('label.video_data') }}</h6>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>

            <!-- Form -->
            <form class="needs-validation" id="my-form" novalidate method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="video_id" name="video_id">

                <div class="modal-body">

                    <!-- Video Title -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label required" for="title_ar">{{ __('label.title') }} (AR)</label>
                            <input type="text" name="title_ar" class="form-control" id="title_ar" required>
                            <div class="title_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label required" for="title_en">{{ __('label.title') }} (EN)</label>
                            <input type="text" name="title_en" class="form-control" id="title_en" required>
                            <div class="title_en error"></div>
                        </div>
                    </div>

                    <!-- Video Description -->
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <label class="form-label" for="description_ar">{{ __('label.description') }} (AR)</label>
                            <textarea name="description_ar" class="form-control" id="description_ar"></textarea>
                            <div class="description_ar error"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="description_en">{{ __('label.description') }} (EN)</label>
                            <textarea name="description_en" class="form-control" id="description_en"></textarea>
                            <div class="description_en error"></div>
                        </div>
                    </div>

                    <!-- Video URL -->
                    <div class="row mb-5">
                        <div class="col-md-6">

                            <label class="form-label required" for="url">{{ __('label.url') }}</label>
                            <input type="url" name="url" class="form-control" id="url" required>
                            <div class="url error"></div>

                        </div>

                        <div class="col-md-6">

                            <label class="form-label">{{ __('label.thumbnail') }}</label>
                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                style="background-image: url('{{ asset('assets/default.png') }}'); margin: auto;">

                                <div class="image-input-wrapper w-125px h-125px" id="logoPreview"
                                    style="background-image: url('{{ asset('assets/default.png') }}');"></div>

                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute top-0 end-0 translate-middle"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                    title="{{ __('label.change_thumbnail') }}">
                                    <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span
                                            class="path2"></span></i>
                                    <input type="file" name="thumbnail" accept=".png, .jpg, .jpeg, .webp" />
                                    <input type="hidden" name="thumbnail_remove" />
                                </label>

                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute bottom-0 end-50 translate-middle-x"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                    title="{{ __('label.remove_thumbnail') }}">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                            </div>

                            <span class="thumbnail error"></span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-5">
                        <label class="form-label">{{ __('label.status') }}</label>
                        <label class="form-switch">
                            <input class="form-check-input" name="is_active" id="is_active" value="1"
                                type="checkbox" checked>
                            <span class="form-check-label"></span>
                        </label>
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
