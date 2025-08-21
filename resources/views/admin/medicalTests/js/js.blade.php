<script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@if (app()->getLocale() === 'ar')
    <script src="{{ asset('assets/js/message_ar.js') }}"></script>
@endif
<script>
    $(document).ready(function() {

        $('[data-kt-data-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });
        const locale = '{{ app()->getLocale() }}'; // Get the current locale
        // Reset form and modal previews when modal is hidden
        $('#kt_modal_add_edit').on('hidden.bs.modal', function() {
            $('.error').text('');
            $('#my-form')[0].reset();
            const form = $('#my-form'); // The form you want to set the action for

            // Set the action attribute of the form
            form.attr('action', "{{ route('admin.medicalTests.store') }}");

            $('.error').text('');

        });





        // Initialize DataTable
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,

            ajax: {
                url: "{{ route('admin.medicalTests.getIndex') }}",
                type: 'get',
                data: function(d) {
                    d.search = $('[data-kt-docs-table-filter="search"]').val();
                },
            },

            columns: [{
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: true,

                },







             \
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: true,
                },
            ],
            order: [
                [0, 'desc']
            ],
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            drawCallback: function() {
                KTMenu.createInstances();
            }


        });

        table.on('preXhr.dt', function() {
            $('#datatable-loader').show(); // إظهار الـ spinner قبل جلب البيانات
        });

        table.on('xhr.dt', function() {
            $('#datatable-loader').hide(); // إخفاء الـ spinner بعد جلب البيانات
        });









        // Search filter

        // Show modal if necessary
        let show_modal = $('#show_modal').val();
        if (show_modal) {
            $('#kt_modal_add_edit').modal('show');
        }
    });
    // Reset form fields and preview images

    $('#my-form').validate({
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
                        toastr.success(response.message, 'Success', {
                            timeOut: 3000
                        });
                        $('#kt_modal_add_edit').modal('hide');
                        $('#data-table').DataTable().ajax.reload();


                    } else {
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });

                    }
                    $('.data-table').DataTable().ajax.reload(null, false);

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
    // View button click



    $(document).on('click', '.add_city', function() {
        $('#kt_modal_add_edit').modal('show');

        let _url = "{{ route('admin.medicalTests.store') }}";

        $('#my-form').attr('action', _url);
        $('#name_ar').val('');
        $('#name_en').val('');
        $('#status').prop('checked', true);



    });
    // Edit button click
    $(document).on('click', '.view, .edit', function() {
        const action = $(this).hasClass('view') ? 'view' : 'add_edit';
        const form = $('#my-form'); // The form you want to set the action for


        // Set the action attribute of the form
        form.attr('action', "{{ route('admin.medicalTests.update') }}");

        const fields = [
            'medical_test_id', 'name_ar', 'name_en',
        ];
        fields.forEach(field => {

            $('#' + action + '_' + field).val($(this).data(field));


        });

       









        const imagePreview = $('#' + action + '_image-preview');

        imagePreview.toggle($(this).data('logo')).attr('src', $(this).data('logo') ||
            '#');

        $('#kt_modal_' + action).modal('show');
    });


    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        var name_delete = $(this).data('name_delete');
        var ids = $(this).data('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);
        $('#confirmModal').modal('show');
    });
    // Confirm delete action
    $(document).on('click', '.delete_submit', function(e) {
        e.preventDefault();

        var ids = $('#Delete_id').val();
        $('#confirmModal').modal('hide');

        // Perform the AJAX delete request
        $.ajax({
            url: '{{ route('admin.medicalTests.delete') }}',
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
                $('.data-table').DataTable().ajax.reload(null, false);

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
