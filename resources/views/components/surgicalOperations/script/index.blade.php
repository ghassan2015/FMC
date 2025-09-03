@push('scripts')
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>




    <script>
        $(document).ready(function() {
            $('#my-form-surgical_operation_user').validate({
                rules: {
                    name_ar: {
                        required: true
                    },
                    name_en: {
                        required: true
                    },









                },

                submitHandler: function(form) {
                    $('#spinner').show();
                    $('#submit-button').prop('disabled', true);
                    var url = $(form).attr('action');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#spinner').hide();
                            $('#submit-button').prop('disabled', false);

                            if (response.success) {
                                toastr.success(response.message, 'Success', {
                                    timeOut: 3000
                                });
                                $('#addSurgicalOperation').modal('hide');

                                // إعادة تحميل الجدول فقط إذا معرف
                                if (typeof surgicalOperationTable !== 'undefined' &&
                                    surgicalOperationTable) {
                                    surgicalOperationTable.ajax.reload(null, false);
                                }
                            } else {
                                toastr.error(response.message, 'Error', {
                                    timeOut: 3000
                                });
                            }
                        },
                        error: function(xhr) {
                            $('#spinner').hide();
                            $('#submit-button').prop('disabled', false);
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(field, messages) {
                                    $('.' + field).text(messages);
                                });
                            } else {
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
            // عند الضغط على زر إضافة اختبار طبي
            $(document).on('click', '.add_surgical_operation', function(e) {

                e.preventDefault();


                const modal = $('#addSurgicalOperation');

                // إعادة ضبط النموذج بالكامل
                const form = $('#my-form-surgical_operation_user')[0];
                form.reset();

                // مسح أي رسائل خطأ
                $('.error').text('');

                // إعادة تهيئة select2 إذا موجود
                form.querySelectorAll('select').forEach(select => {
                    if ($(select).hasClass('select2-hidden-accessible')) {
                        $(select).val(null).trigger('change');
                    }
                });

                // إخفاء معاينة الصورة
                $('#photo_invoice_preview').hide().attr('src', '');

                // إعادة ضبط hidden inputs

                $('#add_edit_user_id').val($('#medical_list_user_id').val()).trigger('change');
                // فتح المودال
                modal.modal('show');
            });

            // عند إغلاق المودال
            $('#addSurgicalOperation').on('hidden.bs.modal', function() {
                const form = $('#my-form-surgical_operation_user')[0];
                form.reset();
                $('.error').text('');
                $('#surgical_operation_user_id').val('');
                $('#surgical_operation_id').val('');
                $(form).find('select').val('').trigger('change');
            });

            $(document).on('change', '#add_edit_surgical_operation_branch_id', function() {
                var branchId = $(this).val();

                getDoctor(branchId);

            });

            function getDoctor(branchId, doctorId = null) {
                var doctorSelect = $('#add_edit_surgical_operation_doctor_id');

                // تفريغ القائمة القديمة
                doctorSelect.empty().append('<option value="">{{ __('label.seleted') }}</option>');

                if (branchId) {
                    $.ajax({
                        url: '{{ route('admin.appointments.getDoctors') }}',
                        type: 'GET',
                        data: {
                            branch_id: branchId
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0) {
                                $.each(data, function(index, doctor) {
                                    doctorSelect.append('<option value="' + doctor.id + '">' +
                                        doctor.name + '</option>');
                                });
                            }

                            // إذا أُرسِل doctorId → اختر الطبيب مباشرة بعد تحميل القائمة
                            if (doctorId) {
                                doctorSelect.val(doctorId).trigger('change');
                            } else {
                                doctorSelect.trigger(
                                    'change'); // فقط لتحديث select2 إذا لم يتم اختيار طبيب
                            }
                        },
                        error: function() {
                            alert('حدث خطأ أثناء تحميل الأطباء');
                        }
                    });
                }
            }



            // عند تغيير حالة status


            $(document).on('click', '.edit_surgical_operation_user', function(e) {
                e.preventDefault();

                const modal = $('#addSurgicalOperation');
                const form = $('#my-form-surgical_operation_user');

                // إعادة ضبط النموذج
                form[0].reset();
                $('.error').text('');
                $(form).find('select').val(null).trigger('change');

                // جلب البيانات من attributes
                const surgical_operation_user_id = $(this).data('surgical_operation_user_id');
                const user_id = $(this).data('user_id');
                const doctor_id = $(this).data('doctor_id');
                const branch_id = $(this).data('branch_id');
                const status = $(this).data('status');

                const title = $(this).data('title');
                const description = $(this).data('description');
                const date = $(this).data('date');
                const time = $(this).data('time');

                // تعبئة الحقول
                $('#add_edit_surgical_operation_id').val(surgical_operation_user_id);
                $('#add_edit_surgical_operation_title').val(title);
                $('#add_edit_surgical_operation_branch_id').val(branch_id).trigger('change');
                $('#add_edit_surgical_operation_status').val(status).trigger('change');
                $('#add_edit_surgical_operation_description').val(description);
                $('#add_edit_surgical_operation_date').val(date);
                $('#add_edit_surgical_operation_time').val(time);
                // لو عندك status
                // $('#add_edit_surgical_operation_status').val(status).trigger('change');
                window.selectedDoctorId = doctor_id;
                getDoctor(branch_id, doctor_id)
                // تغيير action الفورم إلى تحديث
                form.attr('action', '{{ route('admin.surgicalOperations.update') }}');

                // فتح المودال
                modal.modal('show');
            });




        });

        // أولاً: تعريف الجدول مرة واحدة فقط
        var surgicalOperationTable;

        function loadSurgicalOperationsTable(params = {}) {
            if ($.fn.DataTable.isDataTable('#surgical_operation_table')) {
                // إذا كان الجدول معرف مسبقاً لا تعيد إنشاءه، فقط أعد تحميله
                surgicalOperationTable.ajax.reload(null, false);
                return;
            }

            surgicalOperationTable = $('#surgical_operation_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('admin.surgicalOperations.getIndex') }}",
                    type: 'GET',
                    data: function(d) {
                        Object.assign(d, params);
                    },
                    dataSrc: function(response) {
                        $('#surgical_operation_competed').text("(" + response.surgical_operation_competed +
                            ")");
                        $('#surgical_operation_count').text("(" + response.surgical_operation_count + ")");
                        $('#surgical_operation_pendding').text("(" + response.surgical_operation_pendding +
                            ")");
                        return response.data;
                    }
                },
                columns: [{
                        data: 'title',
                        name: 'title',
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
                        name: 'date'
                    },
                    {
                        data: 'time',
                        name: 'time',
                        orderable: false
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [7, 'desc']
                ],
                pageLength: 10,
                lengthMenu: [10, 50, 100, 250, 500],
                drawCallback: function() {
                    KTMenu.createInstances();
                }
            });
        }


        function getFilterValues() {
            return {
                user_id: $('#medical_list_user_id').val(),
                start_date: $('#search_surgical_operation_start_date').val(),
                end_date: $('#search_surgical_operation_end_date').val(),
                status_id: $('#search_surgical_operation_status').val(),
                search: $('[data-kt-docs-table-filter="search_surgical_operation"]').val()
            };
        }

        $('[data-kt-docs-table-filter="search_surgical_operation"]').on('keyup', function() {
            loadSurgicalOperationsTable(getFilterValues());
        });
        $('#search_surgical_operation_start_date, #search_surgical_operation_end_date, #search_surgical_operation_status')
            .on('change',
                function() {
                    loadSurgicalOperationsTable(getFilterValues());
                });

        // تحميل الجدول أول مرة
        loadSurgicalOperationsTable(getFilterValues());



        function toggleSurgicalOperationFilter() {
            const filterSection = document.getElementById("filter-surgical-operation-section");
            filterSection.classList.toggle("d-none");
        }


        $(document).on('click', '.delete_surgical_operation', function(e) {
            e.preventDefault();

            const name_delete = $(this).data('name_delete');
            const id = $(this).data('id');

            // تعبئة الحقول في المودال
            $('#Delete_id').val(id);
            $('#Name_Delete').val(name_delete);

            // إضافة id للزر نفسه
            $('.submit_delete').attr('id', 'delete_surgical_operation');

            // فتح مودال التأكيد
            $('#confirmModal').modal('show');
        });
        // Confirm delete action
        $(document).on('click', '#delete_surgical_operation', function(e) {
            e.preventDefault();

            var ids = $('#Delete_id').val();
            $('#confirmModal').modal('hide');

            // Perform the AJAX delete request
            $.ajax({
                url: '{{ route('admin.surgicalOperations.delete') }}',
                method: 'POST',
                data: {
                    "id": ids,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Show success notification
                        toastr.success(response.message, 'Success', {
                            timeOut: 3000
                        });

                        if (typeof surgicalOperationTable !== 'undefined' &&
                            surgicalOperationTable) {
                            surgicalOperationTable.ajax.reload(null, false);
                        }

                        // Reload the DataTable
                    } else {
                        // Show error notification
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                    loadSurgicalOperationsTable();
                },
                error: function() {
                    // Show general error notification
                    toastr.error('An error occurred. Please try again later.', 'Error', {
                        timeOut: 3000
                    });
                }
            });
        });
    </script>
@endpush
