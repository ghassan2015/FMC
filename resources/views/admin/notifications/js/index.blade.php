    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif
    <script>
        $('#nontification_type').on('change', function() {
            let val = $(this).val();
            if (val == '1') {
                $('.doctors').removeClass('d-none');
                $('.users').addClass('d-none');
                $('#user_id').val(null).trigger('change');
            } else if (val == '2') {
                $('.users').removeClass('d-none');
                $('.doctors').addClass('d-none');
                $('#doctor_id').val(null).trigger('change');
            } else {
                $('.doctors, .users').addClass('d-none');
                $('#doctor_id, #user_id').val(null).trigger('change');
            }
        });

        $("#my-form").validate({

            rules: {
                name: {
                    required: true,

                },





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

                $.ajax({
                    url: _url,
                    type: "post",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {

                        if (response.status) {
                            toastr.success(response.message,
                                "{{ __('label.successfully_process') }}");
                            $('#exampleModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload()

                        } else {
                            toastr.error(response.message, "Error!");

                        }

                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();

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
