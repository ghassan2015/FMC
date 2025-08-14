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
                        toastr.success(response.message, 'Success', { timeOut: 3000 });

                        window.location.reload();

                    } else {
                        toastr.error(response.message, 'Error', { timeOut: 3000 });

                    }
                },
                error: function(xhr) {
                    // Hide the spinner and enable the submit button
                    $('#spinner').hide();
                    $('#submit-button').prop('disabled', false);

                }
            });
        }

    });
</script>
