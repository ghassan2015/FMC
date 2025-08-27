    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    <script>
        Dropzone.autoDiscover = false;

        // === Before Surgical Dropzone ===
        let beforeSurgicalDropzone = new Dropzone("#beforeSurgicalDropzone", {
                    url: "{{ route('admin.categories.before_surgical_upload') }}",
                    maxFilesize: 5, // MB
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png,.webp",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(file, response) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'before_surgical_photos[]';
                        input.value = response.id; // id من DB
                        file._inputElement = input;
                        document.getElementById('my-form').appendChild(input);
                    },
                    removedfile: function(file) {
                        let photoId = file._inputElement ? file._inputElement.value : null;
                        if (photoId) {
                            fetch("{{ route('admin.categories.before_surgical_delete') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    id: photoId
                                })
                            });
                        }
                        if (file._inputElement) file._inputElement.remove();
                        if (file.previewElement) file.previewElement.remove();
                    },
                    init: function() {
                        @if (isset($category->categoryBeforeSurgicalOperations) && count($category->categoryBeforeSurgicalOperations))
                            let existingFiles = {!! json_encode($category->categoryBeforeSurgicalOperations) !!};

                            existingFiles.forEach(file => {
                                let mockFile = {
                                    name: file.photo,
                                    size: file.size || 0,
                                    accepted: true
                                };
                                this.emit("addedfile", mockFile);
                                this.emit("complete", mockFile);

                                // إنشاء رابط قابل للنقر
                                let link = document.createElement('a');
                                link.href = "{{ asset('uploads/categories/after/') }}/" + file.photo;
                                link.target = "_blank";
                                link.innerText = file.photo;
                                link.style.display = "block";
                                link.style.marginTop = "5px";
                                mockFile.previewElement.appendChild(link);

                                // إنشاء input مخفي لكل ملف قديم
                                let input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'before_surgical_photos[]';
                                input.value = file.id; // نرسل id من DB
                                mockFile._inputElement = input;
                                document.getElementById('my-form').appendChild(input);
                            });
                        @endif

                    }
                    });

                // === After Surgical Dropzone ===
                let afterSurgicalDropzone = new Dropzone("#afterSurgicalDropzone", {
                    url: "{{ route('admin.categories.after_surgical_upload') }}",
                    maxFilesize: 5,
                    addRemoveLinks: true,
                    acceptedFiles: ".jpg,.jpeg,.png,.webp",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(file, response) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'after_surgical_photos[]';
                        input.value = response.id;
                        file._inputElement = input;
                        document.getElementById('my-form').appendChild(input);
                    },
                    removedfile: function(file) {
                        let photoId = file._inputElement ? file._inputElement.value : null;
                        if (photoId) {
                            fetch("{{ route('admin.categories.after_surgical_delete') }}", {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    id: photoId
                                })
                            });
                        }
                        if (file._inputElement) file._inputElement.remove();
                        if (file.previewElement) file.previewElement.remove();
                    },
                  init: function() {
                        @if (isset($category->categoryAferSurgicalOperations) && count($category->categoryAferSurgicalOperations))
                            let existingFiles = {!! json_encode($category->categoryAferSurgicalOperations) !!};

                            existingFiles.forEach(file => {
                                let mockFile = {
                                    name: file.photo,
                                    size: file.size || 0,
                                    accepted: true
                                };
                                this.emit("addedfile", mockFile);
                                this.emit("complete", mockFile);

                                // إنشاء رابط قابل للنقر
                                let link = document.createElement('a');
                                link.href = "{{ asset('uploads/categories/after/') }}/" + file.photo;
                                link.target = "_blank";
                                link.innerText = file.photo;
                                link.style.display = "block";
                                link.style.marginTop = "5px";
                                mockFile.previewElement.appendChild(link);

                                // إنشاء input مخفي لكل ملف قديم
                                let input = document.createElement('input');
                                input.type = 'hidden';
                                input.name = 'after_surgical_photos[]';
                                input.value = file.id; // نرسل id من DB
                                mockFile._inputElement = input;
                                document.getElementById('my-form').appendChild(input);
                            });
                        @endif

                    }
                });

                var description_ar = new Quill('#description_ar', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });



                var description_en = new Quill('#description_en', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });
                var signs_ar = new Quill('#signs_ar', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });



                var signs_en = new Quill('#signs_en', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });

                $("#my-form").validate({

                    rules: {






                    },


                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var data = new FormData(document.getElementById("my-form"));
                        var _url = $('#my-form').attr('action');
                        $('#spinner').show();
                        $('.btn-primary').attr('disabled', true);
                        $('.hiden_icon').hide();
                        data.append('description_ar', description_ar.root.innerHTML);
                        data.append('description_en', description_en.root.innerHTML);

                        data.append('signs_en', signs_en.root.innerHTML);
                        data.append('signs_ar', signs_ar.root.innerHTML);

                        $.ajax({
                            url: _url,
                            type: "post",
                            data: data,
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(response) {

                                toastr.success(response.message,
                                    "{{ __('label.successfully_process') }}");
                                $('#exampleModal').modal('hide');



                                $('#spinner').hide();
                                $('.btn-primary').attr('disabled', false);
                                $('.hiden_icon').show();

                                setTimeout(() => {
                                    window.location.href =
                                        "{{ route('admin.categories.index') }}"

                                }, 2000);

                            },
                            error: function(response) {
                                $('#spinner').hide();
                                $('.btn-primary').attr('disabled', false);
                                $('.hiden_icon').show();

                                var errors = response.responseJSON.errors;
                                if (errors) {
                                    var errorText = "";
                                    $.each(errors, function(key, value) {
                                        errorText += value + "\n";
                                        $('.' + key).text(value);
                                    });

                                } else {
                                    toastr.error(response.responseJSON.message, "Error!");


                                }

                            }


                        });


                    }

                });
    </script>
