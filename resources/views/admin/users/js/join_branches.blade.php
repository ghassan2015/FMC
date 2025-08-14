    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif


    <script>
        $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
            $('#kt_datatable_example_1').DataTable().search(this.value).draw();
        });

        function toggleFilter() {
            const filterSection = document.getElementById("filter-section");
            filterSection.classList.toggle("d-none");
        }

        $(document).ready(function() {

            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('admin.users.getJoinBranches') }}",
                    type: 'get',
                    data: function(d) {
                        d.branch_id = $('#search_branch_id').val();


                    },
                },
                columns: [{
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        width: '60px'
                    },
                    {
                        data: 'user_name',
                        name: 'user_name',
                        orderable: false,
                        width: '60px'

                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        orderable: false,
                        width: '60px'

                    },



                    {
                        data: 'total_contracts',
                        name: 'total_contracts',
                        orderable: true
                    },
                    {
                        data: 'total_movements',
                        name: 'total_movements',
                        orderable: true
                    },

                    {
                        data: 'cuurent_branch',
                        name: 'cuurent_branch',
                        orderable: true
                    },
                    {
                        data: 'branch_transfer',
                        name: 'branch_transfer',
                        orderable: true
                    },
                    {
                        data: 'Whatsapp',
                        name: 'Whatsapp',
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '60px'

                    },

                ],
                order: [
                    [0, 'desc']
                ],
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100, 250, 500],
                drawCallback: function() {
                    KTMenu.createInstances();
                }
            });







            // Listen for changes on the new search filters and reload the DataTable
            $(' #search_branch_id')
                .on('change', function() {
                    $('#kt_datatable_example_1').DataTable().ajax.reload();
                });














            let desk_mangment_id = null;
            let room_id = null;

            $(document).on('click', '.add_to_work_space', function(e) {
                e.preventDefault();
                $('#addWorkSpaceModal').modal('show');

                let user_id = $(this).data('user_id'),
                    branch_id = $(this).data('branch_id'),
                    work_space_id = $(this).data('work_space_id'),
                    work_space_type = $(this).data('work_space_type');
                room_id = $(this).data('room_id'),
                    desk_mangment_id = $(this).data('desk_mangment_id');

                $('#add_work_space_user_id').val(user_id);
                $('#add_work_space_type').val(work_space_type).trigger('change');
                $('#add_work_room_id').val(room_id).trigger('change');
                $('#add_work_desk_mangment_id').val(desk_mangment_id).trigger('change');

                fetchWorkSpaces(branch_id, work_space_id);
                if (work_space_type === 1) fetchDeskManagement(work_space_id, desk_mangment_id);
                if (work_space_type === 2) fetchRooms(work_space_id, room_id);
            });


            $('#add_work_space_type').change(function() {
                let work_space_type = $(this).val();
                let work_space_id = $('#add_work_space_id').val();

                $('.desk_mangment').toggle(work_space_type == 1);
                $('.room_mangment').toggle(work_space_type == 2);

                if (work_space_type == 1) fetchDeskManagement(work_space_id, desk_mangment_id);
                if (work_space_type == 2) fetchRooms(work_space_id, room_id);

            });

            function fetchWorkSpaces(branch_id, selected_id) {
                $.ajax({
                    url: '{{ route('admin.users.getByBranch') }}',
                    type: 'GET',
                    data: {
                        branch_id
                    },
                    success: function(response) {
                        populateSelect('#add_work_space_id', response.workSpaces, selected_id);
                    },
                    error: function(response) {
                        console.error('Error:', response);
                    }
                });
            }

            function fetchDeskManagement(work_space_id, selected_id) {
                $.ajax({
                    url: '{{ route('admin.users.getByDeskMangments') }}',
                    type: 'GET',
                    data: {
                        work_space_id
                    },
                    success: function(response) {
                        populateSelect('#add_work_space_desk_mangment_id', response
                            .deskMangments,
                            selected_id);
                    },
                    error: function(response) {
                        console.error('Error:', response);
                    }
                });
            }

            function fetchRooms(work_space_id, selected_id) {
                $.ajax({
                    url: '{{ route('admin.users.getByRooms') }}',
                    type: 'GET',
                    data: {
                        work_space_id
                    },
                    success: function(response) {
                        populateSelect('#add_work_space_room_id', response.rooms, selected_id);
                    },
                    error: function(response) {
                        console.error('Error:', response);
                    }
                });
            }

            function populateSelect(selector, items, selected_id) {
                let select = $(selector);

                // عرض مؤشر تحميل داخل الـ select
                select.html(`<option disabled selected>جارٍ التحميل...</option>`).trigger('change');

                // محاكاة تأخير (يمكن إزالتها إذا كنت تستخدم بيانات جاهزة)
                setTimeout(() => {
                    select.empty(); // حذف الخيارات القديمة

                    $.each(items, function(key, value) {
                        select.append(
                            `<option value="${value.id}">${value.code || value.name}</option>`);
                    });

                    // تحديد العنصر المختار
                    select.val(selected_id).trigger('change');
                }, 300); // تأخير اختياري فقط لتجربة المؤشر
            }
        });








        $("#release-form").validate({
            submitHandler: function(form) {
                handleFormSubmission(form, '#release-form', '#releaseModal');
            }
        });


        function handleFormSubmission(form, formSelector, modalSelector) {
            var $form = $(form);
            var $button = $form.find('button[type="submit"]');
            var $spinner = $button.find('.spinner-border');

            $spinner.show();
            $button.prop('disabled', true);
            $('.error').hide();

            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: new FormData(form),
                processData: false,
                contentType: false,
                success: function(response) {
                    $spinner.hide();
                    $button.prop('disabled', false);

                    if (response.success || response.status) {
                        toastr.success(response.message, '{{ __('label.success') }}', {
                            timeOut: 3000
                        });
                        $(modalSelector).modal('hide');
                        $('.data-table').DataTable().ajax.reload(null, false);
                    } else {
                        toastr.error(response.message, 'Error', {
                            timeOut: 3000
                        });
                    }
                },
                error: function(xhr) {
                    $spinner.hide();
                    $button.prop('disabled', false);

                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $('#' + field + '_error').text(messages.join(', ')).show();
                        });
                    } else {
                        toastr.error(xhr.responseJSON['message'], 'Error', {
                            timeOut: 3000
                        });
                    }
                }
            });
        }


        $(document).on('change', '#add_status', function(e) {
            e.preventDefault();
            if ($(this).val() == 1) {
                $('.branch_id').show();
            } else {
                $('.branch_id').hide();

            }

        });



        let join_branch_url = "";
        $(document).on('click', '.delete_join_branch', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('show')
            var name_delete = $(this).data('name_delete');
            var ids = $(this).data('id');
            $('#Delete_id').val(ids);
            income_movement_url = "{{ route('admin.users.deleteJoinBranch') }}";
            $('.submit_delete').attr('id', 'delete_join_branch');

            $('#Name_Delete').val(name_delete);

        });

        $(document).on('click', '#delete_join_branch', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('hide');

            var ids = $('#Delete_id').val();
            $.ajax({
                url: income_movement_url,
                method: 'POST',
                data: {
                    "id": ids,
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    toastr.success(data.message,
                        '{{ __('label.success') }}', {
                            timeOut: 3000
                        });
                    $('#confirmModal').modal('hide');
                    $('#kt_datatable_example_1').DataTable().ajax.reload(null, false);



                },
                error: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#income_movement_table').DataTable().ajax.reload(null, false);

                }


            });




        });








        // Hides the "office" column
        // التأكد من أن الـ Dropdown يظهر بشكل صحيح فوق الـ Modal
        document.addEventListener("DOMContentLoaded", function() {
            $('#invoiceModal').on('shown.bs.modal', function() {
                $('.dropdown-toggle').dropdown();
            });

            // تعديل الـ z-index يدويًا عند ظهور الـ Dropdown
            $(document).on('show.bs.dropdown', '.dropdown', function() {
                var $dropdownMenu = $(this).find('.dropdown-menu');
                $dropdownMenu.css('z-index', 1080);
            });
        });







        let isProgrammaticChange = false;

        $(document).on('click', '.add_user', function(e) {
            e.preventDefault();
            isProgrammaticChange = true;

            $('#my-form')[0].reset();
                $('#my-form select').val(null).trigger('change');

            var user_id = $(this).data('user_id');
            var branch_id = $(this).data('branch_id');
            var status = $(this).data('status');
            var user_type_id = $(this).data('user_type_cd_id');
            var work_space_id = $(this).data('work_space_id');
            var desk_mangment_id = $(this).data('desk_mangment_id');

            $('#user_type_id').val(user_type_id).trigger('change');
            $('#add_user_branch_id').val(user_id);
            $('#add_branch_id').val(branch_id).trigger('change');
            $('#add_status').val(status).trigger('change');

            if (branch_id) {
                $('.branch_id').show();

                $.ajax({
                    url: '{{ route('admin.users.getByBranch') }}',
                    type: 'GET',
                    data: {
                        branch_id: branch_id
                    },
                    success: function(response) {
                        var $workSpace = $('#add_work_space');
                        $workSpace.empty().append('<option disabled selected>جارٍ التحميل...</option>')
                            .trigger('change');

                        // تعبئة work spaces بعد التحميل
                        setTimeout(() => {
                            $workSpace.empty().append(
                                '<option value="">{{ __('label.select') }}</option>');
                            $.each(response.workSpaces, function(i, ws) {
                                $workSpace.append(
                                    `<option value="${ws.id}" ${ws.id == work_space_id ? 'selected' : ''}>${ws.code || ws.name}</option>`
                                );
                            });
                            $workSpace.trigger('change');
                        }, 300); // يمكن حذف setTimeout لو أردت التنفيذ الفوري

                        // إذا كان work_space_id موجود، جلب المكاتب
                        if (work_space_id) {
                            var $desk = $('#desk_mangment_id');
                            $desk.empty().append('<option disabled selected>جارٍ التحميل...</option>')
                                .trigger('change');

                            $.ajax({
                                url: '{{ route('admin.users.getByDeskMangments') }}',
                                type: 'GET',
                                data: {
                                    work_space_id: work_space_id
                                },
                                success: function(response) {
                                    $desk.empty().append(
                                        '<option value="">{{ __('label.select') }}</option>'
                                    );
                                    $.each(response.deskMangments, function(i, d) {
                                        let userName = d.users ? d.users.name : '';
                                        $desk.append(
                                            `<option value="${d.id}" ${d.id == desk_mangment_id ? 'selected' : ''}>
                                        ${(d.code || d.name)}${userName ? ' - ' + userName : ''}
                                    </option>`
                                        );
                                    });
                                    $desk.trigger('change');
                                    isProgrammaticChange = false;
                                }
                            });
                        } else {
                            isProgrammaticChange = false;
                        }
                    }
                });
            } else {
                isProgrammaticChange = false;
            }

            $('#exampleModal').modal('show');
        });

        // تغيير الفرع يدويًا
        $(document).on('change', '#add_branch_id', function(e) {
            if (isProgrammaticChange) return;
            e.preventDefault();
            var branch_id = $(this).val();
            var $workSpace = $('#add_work_space');

            $workSpace.empty().append('<option disabled selected>جارٍ التحميل...</option>').trigger('change');

            $.ajax({
                url: '{{ route('admin.users.getByBranch') }}',
                type: 'GET',
                data: {
                    branch_id: branch_id
                },
                success: function(response) {
                    $workSpace.empty();
                    $workSpace.append('<option value="">{{ __('label.select') }}</option>');
                    $.each(response.workSpaces, function(i, ws) {
                        $workSpace.append('<option value="' + ws.id + '">' + (ws.code || ws
                            .name) + '</option>');
                    });
                    $workSpace.trigger('change');
                }
            });
        });

        $(document).on('change', '#add_user_branch_id', function(e) {

            branch_id = $(this).val();
            if (branch_id) {
                $.ajax({
                    url: '{{ route('admin.users.getByBranch') }}',
                    type: 'GET',
                    data: {
                        branch_id: branch_id
                    },
                    success: function(response) {
                        var $workSpace = $('#add_work_space');
                        $workSpace.empty();
                        $workSpace.append('<option value="">{{ __('label.select') }}</option>');
                        $.each(response.workSpaces, function(i, ws) {
                            $workSpace.append('<option value="' + ws.id + '"' + (ws.id ==
                                work_space_id ? ' selected' : '') + '>' + (ws.code || ws
                                .name) + '</option>');
                        });
                        $workSpace.trigger('change');

                        if (work_space_id) {
                            $.ajax({
                                url: '{{ route('admin.users.getByDeskMangments') }}',
                                type: 'GET',
                                data: {
                                    work_space_id: work_space_id
                                },
                                success: function(response) {
                                    console.log(response);
                                    var $desk = $('#desk_mangment_id');
                                    $desk.empty();
                                    $desk.append(
                                        '<option value="">{{ __('label.select') }}</option>'
                                    );
                                    $.each(response.deskMangments, function(i, d) {
                                        let userName = d.users ? d.users.name : ' ';

                                        $desk.append('<option value="' + d.id +
                                            '"' +
                                            (d.id == desk_mangment_id ?
                                                ' selected' : '') +
                                            '>' + (d.code || d.name) + (
                                                userName ? ' - ' + userName : ''
                                            ) + '</option>');
                                    });

                                    $desk.trigger('change');
                                    isProgrammaticChange = false;
                                }
                            });
                        } else {
                            isProgrammaticChange = false;
                        }
                    }
                });


            }
        });

        // تغيير مساحة العمل يدويًا
        $(document).on('change', '#add_work_space', function(e) {
            if (isProgrammaticChange) return;

            e.preventDefault();
            var work_space_id = $(this).val();

            if (work_space_id) {
                var $desk = $('#desk_mangment_id');

                // عرض رسالة انتظار مؤقتًا
                $desk.empty().append('<option disabled selected>جارٍ التحميل...</option>').trigger('change');

                $.ajax({
                    url: '{{ route('admin.users.getByDeskMangments') }}',
                    type: 'GET',
                    data: {
                        work_space_id: work_space_id
                    },
                    success: function(response) {
                        $desk.empty().append('<option value="">{{ __('label.select') }}</option>');

                        $.each(response.deskMangments, function(i, d) {
                            let userName = d.users ? d.users.name : '';
                            $desk.append(`
                        <option value="${d.id}">
                            ${(d.code || d.name)}${userName ? ' - ' + userName : ''}
                        </option>
                    `);
                        });

                        $desk.trigger('change');
                    }
                });
            }
        });
















        $("form[name='my-form']").validate({
            rules: {
                status: {
                    required: true,
                },
                branch_id: {
                    required: function() {
                        return $('#add_status').val() == 1;
                    },
                }
            },

            messages: {
                status: "الحالة مطلوبة",
                branch_id: "الفرع مطلوب"
            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData(document.getElementById("my-form"));

                $.ajax({
                    url: '{{ route('admin.users.addToBranch') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function() {
                        $('#send_form').attr('disabled', true);
                        $('.hiden_icon').hide();
                        $('#spinner').show();
                    },

                    success: function(response) {
                        toastr.success(response.message, 'تم بنجاح', {
                            timeOut: 2000
                        });
                        $('#exampleModal').modal('hide');
                        $('.data-table').DataTable().ajax.reload(null, false);
                    },

                    error: function(response) {
                        var errors = response.responseJSON.errors;
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                        });
                        toastr.error(errorText, 'فشل التحقق', {
                            timeOut: 4000
                        });
                    },

                    complete: function() {
                        $('#send_form').attr('disabled', false);
                        $('.hiden_icon').show();
                        $('#spinner').hide();
                    }
                });
            }
        });
    </script>
