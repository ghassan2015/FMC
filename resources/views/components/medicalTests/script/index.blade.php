@push('scripts')

    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    @if (app()->getLocale() === 'ar')
        <script src="{{ asset('assets/js/message_ar.js') }}"></script>
    @endif
    <script>
        function loadMedicalTestTable(params = {}) {
            if ($.fn.DataTable.isDataTable('#medical_test_table')) {
                $('#medical_test_table').DataTable().clear().destroy();
            }

            $('#medical_test_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('admin.medicalTestUsers.getIndex') }}",
                    type: 'get',
                    data: function(d) {
                        Object.assign(d, params);
                    },
                    dataSrc: function(response) {
                        $('#medical_test_competed').text("(" + response.medical_test_competed + ")");
                        $('#medical_test_count').text("(" + response.medical_test_count + ")");
                        $('#medical_test_pendding').text("(" + response.medical_test_pendding + ")");
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
                        data: 'medical_test',
                        name: 'medical_test'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false
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
                    [4, 'desc']
                ], // ترتيب حسب created_at
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
                start_date: $('#search_medical_test_start_date').val(),
                end_date: $('#search_medical_test_end_date').val(),
                status_id: $('#search_medical_test_status').val(),
                search: $('[data-kt-docs-table-filter="search_medical_test"]').val()
            };
        }

        $('[data-kt-docs-table-filter="search_medical_test"]').on('keyup', function() {
            loadMedicalTestTable(getFilterValues());
        });
        $('#search_medical_test_start_date, #search_medical_test_end_date, #search_medical_test_status').on('change',
            function() {
                loadMedicalTestTable(getFilterValues());
            });

        // تحميل الجدول أول مرة
        loadMedicalTestTable(getFilterValues());


        $(document).ready(function() {

            // عند الضغط على زر إضافة اختبار طبي
            $(document).on('click', '.add_medical_test', function() {
                const modal = $('#addMedicalTest');

                // إعادة ضبط النموذج بالكامل
                const form = $('#my-form-medical_clinic_user')[0];
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
            $('#addMedicalTest').on('hidden.bs.modal', function() {
                const form = $('#my-form-medical_clinic_user')[0];
                form.reset();
                $('.error').text('');
                $('#photo_invoice_preview').hide().attr('src', '');
                $('#medical_test_user_id').val('');
                $('#medical_test_id').val('');
                $(form).find('select').val(null).trigger('change');
            });

            // عند تغيير حالة status
            $('#add_edit_medical_test_status').on('change', function() {
                const status = $(this).val();
                if (status == 2) {
                    $('#photo_invoice_preview').show();
                } else {
                    $('#photo_invoice_preview').hide();
                }
            });

            $(document).on('click', '.edit_medical_test_user', function(e) {
                e.preventDefault();

                const modal = $('#addMedicalTest');
                const form = $('#my-form-medical_clinic_user');

                // إعادة ضبط النموذج
                form[0].reset();
                $('.error').text('');
                $('#photo_invoice_preview').hide().attr('src', '');
                $(form).find('select').val(null).trigger('change');

                // جلب البيانات من attributes
                const medical_test_id = $(this).data('medical_test_id');
                const medical_test_user_id = $(this).data('medical_test_user_id');
                const status = $(this).data('status');
                const photo = $(this).data('photo');
                const user_id = $(this).data('user_id');

                // تعبئة hidden inputs
                $('#medical_test_user_id').val(medical_test_user_id);
                $('#medical_id').val(medical_test_user_id); // أو medical_id حسب اسم الحقل الصحيح
                $('#add_edit_medical_test_id').val(medical_test_id).trigger('change');
                $('#add_edit_user_id').val(user_id).trigger('change');

                // تعبئة select الحالة
                $('#add_edit_medical_test_status').val(status).trigger('change');

                // عرض صورة المعاينة إذا كانت موجودة
                if (photo) {
                    $('#photo_invoice_preview').attr('src', photo).show();
                } else {
                    $('#photo_invoice_preview').hide();
                }

                // تغيير action الفورم إلى تحديث
                form.attr('action', '{{ route('admin.medicalTestUsers.update') }}');

                // فتح المودال
                modal.modal('show');
            });

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

        });

        function toggleMedicalTestFilter() {
            const filterSection = document.getElementById("filter-medical-test-section");
            filterSection.classList.toggle("d-none");
        }

        $('#my-form-medical_clinic_user').validate({
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
                var url = $('#my-form-medical_clinic_user').attr('action');
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
                            toastr.success(response.message, 'Success', {
                                timeOut: 3000
                            });
                            $('#addMedicalTest').modal('hide');


                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });

                        }
                        $('#medical_test_table').DataTable().ajax.reload(null, false);

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
        $(document).on('click', '.delete_medical_test', function(e) {
            e.preventDefault();

            const name_delete = $(this).data('name_delete');
            const id = $(this).data('id');

            // تعبئة الحقول في المودال
            $('#Delete_id').val(id);
            $('#Name_Delete').val(name_delete);

            // إضافة id للزر نفسه
            $('.submit_delete').attr('id', 'delete_medical_test');

            // فتح مودال التأكيد
            $('#confirmModal').modal('show');
        });
        // Confirm delete action
        $(document).on('click', '#delete_medical_test', function(e) {
            e.preventDefault();

            var ids = $('#Delete_id').val();
            $('#confirmModal').modal('hide');

            // Perform the AJAX delete request
            $.ajax({
                url: '{{ route('admin.medicalTestUsers.delete') }}',
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

                        // Reload the DataTable
                    } else {
                        // Show error notification
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                    $('#medical_test_table').DataTable().ajax.reload(null, false);

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
