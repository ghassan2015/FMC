@push('scripts')

    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @if (app()->getLocale() === 'ar')
        <script src="{{ asset('assets/js/message_ar.js') }}"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <script>
        var appointment_table;

        function loadAppointmentTable(params = {}) {
            if ($.fn.DataTable.isDataTable('#appointment_table')) {
                if (appointment_table) appointment_table.ajax.reload(null, false);
                return;
            }

            appointment_table = $('#appointment_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('admin.appointments.getIndex') }}",
                    type: "GET",
                    data: function(d) {
                        Object.assign(d, params);


                    },

                    dataSrc: function(response) {
                        // تحديث الإحصائيات
                        $('#appointment_count').text(response.appointment_count);
                        $('#appointment_month_count').text(response.appointment_month_count);
                        $('#appointment_day_count').text(response.appointment_day_count);
                        $('#appointment_pendding_count').text(response.appointment_pendding_count);

                        // إعادة بيانات الصفوف للـ DataTable
                        return response.data;
                    }
                },
                columns: [{
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'doctor_name',
                        name: 'doctor_name'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        orderable: false
                    },
                    {
                        data: 'time',
                        name: 'time',
                        orderable: false
                    },
                    {
                        data: 'payment_type',
                        name: 'payment_type'
                    },
                    {
                        data: 'is_paid',
                        name: 'payment_status'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [3, 'desc']
                ],
                pageLength: 10,
            });
        }


        function getFilterValues() {
            return {
                user_id: $('#appointment_user_id').val(),
                start_date: $('#search_appointment_start_date').val(),
                end_date: $('#search_appointment_end_date').val(),
                doctor_id: $('#search_doctor_id').val(),
                status_id: $('#search_appointment_status').val(),
                search: $('[data-kt-docs-table-filter="search_appointment"]').val()
            };
        }

        $('[data-kt-docs-table-filter="search_appointment"]').on('keyup', function() {
            loadAppointmentTable(getFilterValues());
        });
        $('#appointment_user_id,#search_doctor_id, #search_appointment_start_date, #search_appointment_end_date,#search_appointment_status')
            .on('change',
                function() {
                    loadAppointmentTable(getFilterValues());
                });

        // تحميل الجدول أول مرة

        @can('view_appointment')
            loadAppointmentTable(getFilterValues());
        @endcan

        $(document).ready(function() {

            // عند الضغط على زر إضافة اختبار طبي
            $(document).on('click', '.add_appointment', function() {
                const modal = $('#appointmentModal');

                // إعادة ضبط النموذج بالكامل
                const form = $('#my-form-apointment')[0];
                form.reset();

                // مسح أي رسائل خطأ
                $('.error').text('');

                // إعادة تهيئة select2 إذا موجود
                form.querySelectorAll('select').forEach(select => {
                    if ($(select).hasClass('select2-hidden-accessible')) {
                        $(select).val(null).trigger('change');
                    }
                });


                $('#add_edit_user_id').val($('#appointment_user_id').val()).trigger('change');
                // فتح المودال
                modal.modal('show');
            });



            $(document).on('change', '#AppointmentBranch', function() {
                var branchId = $(this).val();
                var doctorSelect = $('#doctorAppointment');

                // تفريغ القائمة القديمة
                doctorSelect.empty().append('<option value="">{{ __('label.seleted') }}</option>');

                if (branchId) {
                    $.ajax({
                        url: '{{ route('admin.appointments.getDoctors') }}', // بدون تمرير ID في الرابط
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


            $('#appointmentDate,#doctorAppointment,#AppointmentBranch').change(function() {
                let doctorId = $('#doctorAppointment').val();
                let branchId = $('#AppointmentBranch').val();
                let date = $('#appointmentDate').val();

                if (doctorId && branchId && date) {
                    $.get('{{ route('admin.doctors.getAvailableTimes') }}', {
                        doctor_id: doctorId,
                        branch_id: branchId,
                        date: date
                    }, function(times) {
                        $('#availableTimes').empty();

                        if (times.length === 0) {
                            $('#availableTimes').append(
                                '<span class="text-danger fw-bold">لا توجد مواعيد متاحة</span>'
                            );
                        } else {
                            times.forEach(time => {
                                $('#availableTimes').append(
                                    `<button type="button" class="btn btn-outline-primary time-btn">${time}</button>`
                                );
                            });

                            // اختيار الوقت عند الضغط
                            $('.time-btn').click(function() {
                                $('.time-btn').removeClass('btn-primary text-white')
                                    .addClass('btn-outline-primary');
                                $(this).removeClass('btn-outline-primary').addClass(
                                    'btn-primary text-white');
                                $('#selectedTime').val($(this)
                                    .text()); // افترض عندك input مخفي
                            });
                        }
                    });
                }
            });



            $('#appointmentModal').on('hidden.bs.modal', function() {
                const form = $('#my-form-apointment')[0];
                form.reset();
                $('.error').text('');
                $(form).find('select').val(null).trigger('change');
            });

            // عند تغيير حالة status



            $('#add_edit_photo').on('change', function() {
                const file = this.files[0];
                const preview = $('#photo_invoice_preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.hide().attr('src', '');
                }
            });



            $(document).on('click', '.edit', function(e) {
                e.preventDefault();

                const modal = $('#appointmentModal');
                const form = $('#my-form-apointment')[0];

                // إعادة ضبط الفورم بالكامل
                form.reset();
                $('.error').text('');
                $(form).find('select').val(null).trigger('change');
                $('#availableTimes').empty();

                // جلب البيانات من attributes
                const appointmentId = $(this).data('appointment_id');
                const userId = $(this).data('user_id');
                const branchId = $(this).data('branch_id');
                const doctorId = $(this).data('doctor_id');
                const date = $(this).data('date');
                const time = $(this).data('time');
                const isPaid = $(this).data('is_paid');
                const paymentTypeId = $(this).data('payment_type_id');
                const appointmentStatusId = $(this).data('appointment_status_cd_id');

                // تعبئة الحقول
                $('#appointment_id').val(appointmentId);
                $('#userSelect').val(userId).trigger('change');
                $('#AppointmentBranch').val(branchId).trigger('change');
                $('#appointmentDate').val(date);
                $('#is_paid').val(isPaid).trigger('change');
                $('#payment_type_id').val(paymentTypeId).trigger('change');
                $('#appointment_status_id').val(appointmentStatusId).trigger('change');

                // جلب الدكاترة للفرع ثم تحديد الطبيب المختار
                if (branchId) {
                    $.ajax({
                        url: '{{ route('admin.appointments.getDoctors') }}',
                        type: 'GET',
                        data: {
                            branch_id: branchId
                        },
                        dataType: 'json',
                        success: function(doctors) {
                            const doctorSelect = $('#doctorAppointment');
                            doctorSelect.empty().append(
                                '<option value="">{{ __('label.selected') }}</option>');

                            if (doctors.length > 0) {
                                $.each(doctors, function(index, doctor) {
                                    doctorSelect.append('<option value="' + doctor.id +
                                        '">' + doctor.name + '</option>');
                                });
                            }

                            // تحديد الطبيب المختار
                            doctorSelect.val(doctorId).trigger('change');

                            // بعد تحديد الطبيب، تحميل الأوقات المتاحة مع استثناء الموعد الحالي
                            loadAvailableTimes(doctorId, branchId, date, time, appointmentId);
                        },
                        error: function() {
                            alert('حدث خطأ أثناء تحميل الأطباء');
                        }
                    });
                }

                // تحديث الأوقات عند تغيير الطبيب، الفرع أو التاريخ
                $('#doctorAppointment, #AppointmentBranch, #appointmentDate').off('change').on('change',
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
                $('#my-form-apointment').attr('action', '{{ route('admin.appointments.update') }}');

                // فتح المودال
                modal.modal('show');
            });

            // دالة تحميل الأوقات المتاحة مع استثناء الموعد الحالي
            function loadAvailableTimes(doctorId, branchId, date, selectedTime = null, appointmentId = null) {
                if (doctorId && branchId && date) {
                    $.get('{{ route('admin.doctors.getAvailableTimes') }}', {
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
                                $('#availableTimes').append(
                                    `<button type="button" class="btn time-btn ${isSelected}">${time.substring(0,5)}</button>`
                                );
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




        });



        function toggleAppointmentsFilter() {
            const filterSection = document.getElementById("filter-appointment-section");
            filterSection.classList.toggle("d-none");
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
                        $('#appointmentModal').modal('hide');

                        if (typeof appointment_table !== 'undefined' &&
                            appointment_table) {
                            appointment_table.ajax.reload(null, false);
                        }
                    },
                    error: function(xhr) {
                        // Hide the spinner and enable the submit button
                        $('#spinner').hide();
                        $('#submit-button').prop('disabled', false);
                        if (xhr.status === 422) {
                            // Loop through the validation errors and display them with toastr
                            var errors = xhr.responseJSON.errors;
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
        $(document).on('click', '.delete_appointment', function(e) {
            e.preventDefault();

            const name_delete = $(this).data('name_delete');
            const id = $(this).data('id');

            // تعبئة الحقول في المودال
            $('#Delete_id').val(id);
            $('#Name_Delete').val(name_delete);

            // إضافة id للزر نفسه
            $('.submit_delete').attr('id', 'delete_appointment');

            // فتح مودال التأكيد
            $('#confirmModal').modal('show');
        });
        // Confirm delete action
        $(document).on('click', '#delete_appointment', function(e) {
            e.preventDefault();

            var ids = $('#Delete_id').val();
            $('#confirmModal').modal('hide');

            // Perform the AJAX delete request
            $.ajax({
                url: '{{ route('admin.appointments.delete') }}',
                method: 'POST',
                data: {
                    "id": ids,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == 201) {
                        toastr.success(response.message, 'Success', {
                            timeOut: 3000
                        });

                        // Reload the DataTable
                    } else {
                        // Show error notification
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                    $('#appointment_table').DataTable().ajax.reload(null, false);

                },
                error: function() {
                    // Show general error notification
                    toastr.error('An error occurred. Please try again later.', 'Error', {
                        timeOut: 3000
                    });
                }
            });
        });




        // عند اختيار الفرع أو التاريخ → جلب المواعيد المتاحة

        $(document).on('click', '#availableTimes button', function() {
            // Remove active class from all buttons
            $('#availableTimes button').removeClass('btn-primary').addClass('btn-outline-primary');

            // Add active class to the clicked button
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            // Store the selected time in hidden input
            $('#selectedTime').val($(this).text());
        });



        $(document).on('change', '#userSelect', function(e) {
            e.preventDefault();
            if ($(this).val() === 'new') {
                $('.new_user').removeClass('d-none'); // عرض حقول المستخدم الجديد
                // مسح القيم القديمة إذا أحببت
                $('.new_user input').val('');
            } else {
                $('.new_user').addClass('d-none'); // إخفاء حقول المستخدم الجديد
            }
        });
    </script>
@endpush
