<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>
        $('#kt_account_profile_details_form').validate({
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                mobile: { required: true, digits: true },
            },
            messages: {
                name: "هذا الحقل مطلوب",
                email: {
                    required: "هذا الحقل مطلوب",
                    email: "الايميل غير صحيح",
                },
                mobile: {
                    required: "هذا الحقل مطلوب",
                    digits: "يجب ان يكون رقم",
                },
            },
            submitHandler: function (form) {
                // Show the spinner and disable the submit button
                $('#spinner').show();
                $('#submit-button').prop('disabled', true);

                // AJAX request to submit the form data
                $.ajax({
                    url: '{{ route('admin.profile.profile') }}', // Update with your URL
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.text-danger').text('');
                        // You could add a loading spinner here if needed
                    },
                    success: function (response) {
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        // Handle the response on success
                        if (response.success) {
                            toastr.success('<i class="las la-tint text-success"></i> ' + response.message, 'نجاح العملية');
                            window.location.reload();

                        } else {
                            toastr.error("An error occurred while updating your profile.");
                        }
                    },
                    error: function (xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);

                        // Check if there are validation errors
                        if (xhr.status === 422) {
                            // Unprocessable Entity
                            const errors = xhr.responseJSON.errors;
                            if (errors) {
                                for (const [key, messages] of Object.entries(errors)) {
                                    messages.forEach(message => {
                                        toastr.error(message); // Display each error message
                                    });
                                    $('.'+key).text(messages);

                                }
                            } else {
                                toastr.error("An error occurred while updating your profile.");
                            }
                        } else {
                            toastr.error("An unexpected error occurred.");
                        }
                    }
                });
            }
        });


        $('#kt_account_profile_password_form').validate({
            rules: {
                current_password: { required: true },
                new_password: { required: true, },
                confirm_new_password: { required: true },
            },
            messages: {
                current_password: "هذا الحقل مطلوب",
                new_password: {
                    required: "هذا الحقل مطلوب",
                },
                confirm_new_password: {
                    required: "هذا الحقل مطلوب",

                },
            },
            submitHandler: function (form) {
                // Show the spinner and disable the submit button
                $('#spinner').show();
                $('#password_submit-button').prop('disabled', true);

                // AJAX request to submit the form data
                $.ajax({
                    url: '{{ route('admin.profile.changePassword') }}', // Update with your URL
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.text-danger').text('');
                        // You could add a loading spinner here if needed
                    },
                    success: function (response) {
                        $('#password_spinner').hide();
                        $('#password_submit-button').prop('disabled', false);

                        // Handle the response on success
                        if (response.success) {
                            toastr.success('<i class="las la-tint text-success"></i> ' + response.message, '{{ __('messages.success') }}');

                            window.location.reload();
                        } else {
                            toastr.error("An error occurred while updating your profile.");
                        }
                    },
                    error: function (xhr) {
                        // Hide the spinner and enable the submit button
                        $('#password_spinner').hide();
                        $('#password_submit-button').prop('disabled', false);

                        // Check if there are validation errors
                        if (xhr.status === 422) {
                            // Unprocessable Entity
                            const errors = xhr.responseJSON.errors;
                            if (errors) {
                                for (const [key, messages] of Object.entries(errors)) {
                                    messages.forEach(message => {
                                        toastr.error(message); // Display each error message
                                    });
                                    $('.'+key).text(messages);

                                }
                            } else {
                                toastr.error("An error occurred while updating your profile.");
                            }
                        } else {
                            toastr.error("An unexpected error occurred.");
                        }
                    }
                });
            }
        });



</script>
