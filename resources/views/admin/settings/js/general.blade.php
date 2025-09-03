<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
    // var options = {selector: ".kt_docs_tinymce_basic", height : "480"};

    // if ( KTThemeMode.getMode() === "dark" ) {
    //     options["skin"] = "oxide-dark";
    //     options["content_css"] = "dark";
    // }

    // tinymce.init(options);

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewSecondaryImage(event) {
        const secondaryReader = new FileReader();
        secondaryReader.onload = function() {
            const output = document.getElementById('secondary-image-preview');
            output.src = secondaryReader.result;
            output.style.display = 'block';
        };
        secondaryReader.readAsDataURL(event.target.files[0]);
    }

    function previewThirtyImage(event) {
        const secondaryReader = new FileReader();
        secondaryReader.onload = function() {
            const output = document.getElementById('three-image-preview');
            output.src = secondaryReader.result;
            output.style.display = 'block';
        };
        secondaryReader.readAsDataURL(event.target.files[0]);
    }





    var about_us_ar = new Quill('#about_us_ar', {
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




    var about_us_en = new Quill('#about_us_en', {
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



    var term_condition_ar = new Quill('#term_condition_ar', {
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



    var term_condition_en = new Quill('#term_condition_en', {
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



    var privacy_policy_ar = new Quill('#privacy_policy_ar', {
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


    var privacy_policy_en = new Quill('#privacy_policy_en', {
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

    $("#page-form").validate({
        rules: {



            // Add other rules for additional fields as needed
        },

        submitHandler: function(form) {
            $('#spinner').show();
            $('#submit-button').prop('disabled', true);
            var url = $('#page-form').attr('action');


            var data = new FormData(document.getElementById("page-form"));

            data.append('about_us_ar', about_us_ar.root.innerHTML);
            data.append('about_us_en', about_us_en.root.innerHTML);

            data.append('term_condition_ar', term_condition_ar.root.innerHTML);
            data.append('term_condition_en', term_condition_en.root.innerHTML);
            data.append('privacy_policy_ar', privacy_policy_ar.root.innerHTML);
            data.append('privacy_policy_en', privacy_policy_en.root.innerHTML);

            $.ajax({
                url: url, // Update with your URL
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                success: function(response) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    // Handle the response on success
                    if (response.success) {
                        toastr.success(response.message, '{{ __('label.success') }}', {
                            timeOut: 3000
                        });

                        window.location.reload();

                    } else {
                        toastr.error(response.message, '{{ __('label.error') }}', {
                            timeOut: 3000
                        });

                    }
                },
                error: function(response) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

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
                        toastr.error(response.responseJSON.message,
                            "{{ __('message.process_fail') }}");

                    }

                }

            });
        }

    });

    $("#my-form").validate({
        rules: {

            name: {
                required: true,
                maxlength: 255
            },
            description: {
                required: true,
            },

            // Add other rules for additional fields as needed
        },
        messages: {
            name: {
                required: "اسم المؤسسة  الموقع مطلوب",
                maxlength: "الحد الاقصى 255 حرف"
            },

            description: {
                required: "وصف  لموقع مطلوب"
            },


            // Add custom messages for additional fields as needed
        },
        submitHandler: function(form) {
            $('#spinner').show();
            $('#submit-button').prop('disabled', true);
            var url = $('#my-form').attr('action');
            $.ajax({
                url: url, // Update with your URL
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                beforeSend: function() {

                },
                success: function(response) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                    // Handle the response on success
                    if (response.success) {
                        toastr.success(response.message, '{{ __('label.success') }}', {
                            timeOut: 3000
                        });

                        window.location.reload();

                    } else {
                        toastr.error(response.message, '{{ __('label.error') }}', {
                            timeOut: 3000
                        });

                    }
                },
                error: function(response) {
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

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
                        toastr.error(response.responseJSON.message,
                            "{{ __('message.process_fail') }}");

                    }

                }

            });
        }

    });
</script>
