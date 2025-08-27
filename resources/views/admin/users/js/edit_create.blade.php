    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif
    <script>
        $("#my-form").validate({
            // Specify validation rules
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                mobile: {
                    required: true,
                    minlength: 10
                },
                birth_date: {
                    required: true,
                },

                photo: {
                    required: false,
                    extension: "jpg|jpeg|png|gif"
                },

            },


            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                var data = new FormData(document.getElementById("my-form"));
                var actionUrl = $("form[name='my-form']").attr("action");
                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: "toast-top-center",
                            timeOut: "2000",
                            onHidden: function() {
                                window.location.href = "{{ route('admin.users.index') }}";
                            }
                        };

                        // عرض الإشعار
                        toastr.success(response.message);

                    },
                    error: function(xhr) {
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();

                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them
                            var errors = xhr.responseJSON
                                .errors; // الحصول على الأخطاء من الخادم
                            for (var field in errors) {
                                $('#' + field + '_error').text(errors[field][
                                    0
                                ]); // عرض رسالة الخطأ في العنصر المناسب
                            }
                        } else {
                            // Display generic error message for other types of errors
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: xhr.responseJSON.message ||
                                    'An error occurred. Please try again.',
                            });
                        }
                    }

                });
            }
        });
    </script>
