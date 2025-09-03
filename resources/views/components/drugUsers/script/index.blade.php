@push('scripts')
    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    @if (app()->getLocale() === 'ar')
        <script src="{{ asset('assets/js/message_ar.js') }}"></script>
    @endif

    <script>
        // ========================
        // Load Medical Test Table
        // ========================
        $(document).ready(function() {

            // Add Drug User
            $(document).on('click', '.add_drug_user', function() {

                alert('asas');
                const modal = $('#addDrugUser');
                const form = $('#my-form-drug-user')[0];
                form.reset();
                $('.error').text('');
                $(form).find('select').val(null).trigger('change');
                modal.modal('show');
            });

            // Reset modal on close
            $('#addDrugUser').on('hidden.bs.modal', function() {
                const form = $('#my-form-drug-user')[0];
                form.reset();
                $('.error').text('');
                $('#photo_invoice_preview').hide().attr('src', '');
                $('#medical_test_user_id').val('');
                $('#medical_test_id').val('');
                $(form).find('select').val(null).trigger('change');
            });

            // Show/hide photo preview based on status

            // Edit Drug User
            $(document).on('click', '.edit_drug_user', function(e) {
                e.preventDefault();

                const modal = $('#addDrugUser');
                const form = $('#my-form-drug-user');

                form[0].reset();
                $('.error').text('');

                // Get data attributes
                const drug_id = $(this).data('drug_id');
                const name = $(this).data('name');
                const number_time_use = $(this).data('number_time_use');

                // Fill hidden inputs
                $('#number_time_use').val(number_time_use);
                $('#drug_name').val(name);
                $('#drug_id').val(drug_id);


                // Show photo preview


                // Set form action to update
                form.attr('action', '{{ route('admin.drugUsers.update') }}');

                modal.modal('show');
            });

            // ========================
            // Form Validation & Submit
            // ========================
            $('#my-form-drug-user').validate({
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
                            } else {
                                toastr.error(response.message, 'Error', {
                                    timeOut: 3000
                                });
                            }
                                $('#addDrugUser').modal('hide');

                            $('#drug_user_table').DataTable().ajax.reload(null, false);
                        },
                        error: function(xhr) {
                            $('#spinner').hide();
                            $('#submit-button').prop('disabled', false);

                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
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

            // ========================
            // Delete Drug User
            // ========================
            $(document).on('click', '.delete_drug_user', function(e) {
                e.preventDefault();
                const name_delete = $(this).data('name_delete');
                const id = $(this).data('id');

                $('#Delete_id').val(id);
                $('#Name_Delete').val(name_delete);
                $('.submit_delete').attr('id', 'delete_drug_user');
                $('#confirmModal').modal('show');
            });

            $(document).on('click', '#delete_drug_user', function(e) {
                e.preventDefault();
                const ids = $('#Delete_id').val();
                $('#confirmModal').modal('hide');

                $.ajax({
                    url: '{{ route('admin.drugUsers.delete') }}',
                    method: 'POST',
                    data: {
                        "id": ids,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message, 'Success', {
                                timeOut: 3000
                            });
                        } else {
                            toastr.error(response.message, 'Error', {
                                timeOut: 3000
                            });
                        }
                        $('#drug_user_table').DataTable().ajax.reload(null, false);
                    },
                    error: function() {
                        toastr.error('An error occurred. Please try again later.', 'Error', {
                            timeOut: 3000
                        });
                    }
                });
            });

        });

        var drug_user_table;

        function loadMedicalTestTable(params = {}) {

            if ($.fn.DataTable.isDataTable('#drug_user_table')) {
                if (drug_user_table) drug_user_table.ajax.reload(null, false);
                return;

            }

        drug_user_table=    $('#drug_user_table').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                ajax: {
                    url: "{{ route('admin.drugUsers.getIndex') }}",
                    type: 'GET',
                    data: function(d) {
                        Object.assign(d, params);
                    },
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'number_time_use',
                        name: 'number_time_use'
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
                    [2, 'desc']
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

        // ========================
        // Table Search
        // ========================
        $('[data-kt-docs-table-filter="search_drug_user"]').on('keyup', function() {
            loadMedicalTestTable(getFilterValues());
        });

        @can('view_drug_user')
        // Initial table load
        loadMedicalTestTable(getFilterValues());

        @endcan

        // ========================
        // Modal: Add / Edit Drug User
        // ========================
    </script>
@endpush
