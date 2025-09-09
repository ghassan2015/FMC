    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick-animation.min.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.utils.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.transitions.js') }}"></script>
    <script src="{{ asset('assets/js/layerslider.kreaturamedia.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vscustom-carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/universal-parallax.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/ajax-mail.js') }}"></script>


    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() === 'ar')
        <script src="{{ asset('assets/js/message_ar.js') }}"></script>
    @endif
    <script>
        $(document).on('change', '#AppointmentBranch', function() {
            var branchId = $(this).val();
            var doctorSelect = $('#doctorAppointment');

            // تفريغ القائمة القديمة
            doctorSelect.empty().append('<option value="">{{ __('label.selected') }}</option>');

            if (branchId) {
                $.ajax({
                    url: '{{ route('front.appointments.getDoctors') }}', // بدون تمرير ID في الرابط
                    type: 'GET', // يمكن تحويلها لـ POST إذا أردت
                    data: {
                        branch_id: branchId
                    }, // هنا الإرسال في البيانات
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, doctor) {
                                doctorSelect.append('<option value="' + doctor.id +
                                    '">' +
                                    doctor.name + '</option>');
                            });
                        }
                        doctorSelect.trigger('change'); // تحديث select2
                    },
                    error: function() {
                        alert('حدث خطأ أثناء تحميل الأطباء');
                    }
                });
            }
        });



        $('#doctorAppointment, #AppointmentBranch, #appointmentDate').on('change',
            function() {
                const selectedDoctor = $('#doctorAppointment').val();
                const selectedBranch = $('#AppointmentBranch').val();
                const selectedDate = $('#appointmentDate').val();
                const currentAppointmentId = $('#appointment_id').val();

                if (selectedDoctor && selectedBranch && selectedDate) {
                    loadAvailableTimes(selectedDoctor, selectedBranch, selectedDate, null,
                        currentAppointmentId);
                }
            });


        function loadAvailableTimes(doctorId, branchId, date, selectedTime = null, appointmentId = null) {
            if (doctorId && branchId && date) {
                $.get('{{ route('front.appointments.getAvailableTimes') }}', {
                    doctor_id: doctorId,
                    branch_id: branchId,
                    date: date,
                    appointment_id: appointmentId // استثناء الموعد الحالي
                }, function(times) {
                    $('#availableTimes').empty();

                    if (times.length === 0) {
                        $('#availableTimes').append(
                            '<span class="text-danger fw-bold">لا توجد مواعيد متاحة</span>');
                    } else {
                        const formattedSelectedTime = selectedTime ? selectedTime.length === 5 ?
                            selectedTime + ":00" : selectedTime : null;

                        times.forEach(time => {
                            const isSelected = formattedSelectedTime === time ?
                                'btn-primary text-white' : 'btn-outline-primary';
                            $('#availableTimes').append(`
    <button type="button"
        class="btn btn-outline-primary time-btn m-2 px-3 py-2 rounded-pill shadow-sm ${isSelected}"
        data-time="${time}">
        <i class="far fa-clock me-1"></i> ${time.substring(0,5)}
    </button>
`);

                        });

                        // اختيار الوقت عند الضغط
                        $('.time-btn').off('click').on('click', function() {
                            $('.time-btn').removeClass('btn-primary text-white').addClass(
                                'btn-outline-primary');
                            $(this).removeClass('btn-outline-primary').addClass(
                                'btn-primary text-white');
                            $('#selectedTime').val($(this).text() + ":00");
                        });

                        if (formattedSelectedTime) {
                            $('#selectedTime').val(formattedSelectedTime);
                        }
                    }
                });
            }
        }

        $('#my-form-apointment').validate({
            rules: {









            },

            submitHandler: function(form) {
                $('#spinner').show();
                $('#submit-button').prop('disabled', true);
                var url = $('#my-form-apointment').attr('action');
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
                        $('#my-form-apointment')[0].reset();

                        // Handle the response on success
                        if (response.status == 201) {
                            toastr.success(response.message, 'Success', {
                                timeOut: 3000
                            });


                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });

                        }




                    },
                    error: function(xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);
                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them with toastr
                            var errors = xhr.errors;
                            $.each(errors, function(field, messages) {
                                $('.' + field).text(messages);
                            });
                        } else {
                            // For other errors, display a general error message
                            toastr.error(
                                '{{ __('messages.An error occurred. Please try again later') }}',
                                'Error', {
                                    timeOut: 3000
                                });
                        }

                    }
                });
            }
        });


        $('#my-form-contact-us').validate({
            rules: {









            },

            submitHandler: function(form) {
                $('#spinner').show();
                $('#submit-button').prop('disabled', true);
                var url = $('#my-form-contact-us').attr('action');
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
                        $('#my-form-contact-us')[0].reset();

                        // Handle the response on success
                            toastr.success(response.message, 'Success', {
                                timeOut: 3000
                            });


                       




                    },
                    error: function(xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);
                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them with toastr
                            var errors = xhr.errors;
                            $.each(errors, function(field, messages) {
                                $('.' + field).text(messages);
                            });
                        } else {
                            // For other errors, display a general error message
                            toastr.error(
                                '{{ __('messages.An error occurred. Please try again later') }}',
                                'Error', {
                                    timeOut: 3000
                                });
                        }

                    }
                });
            }
        });
    </script>
