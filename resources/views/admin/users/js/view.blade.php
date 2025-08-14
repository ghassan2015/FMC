    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>


    <script>
        let isProgrammaticChange = false;


        $(document).on('click', '.add_user', function(e) {
            e.preventDefault();
            isProgrammaticChange = true;

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




        $(document).on('click', '.verification_user', function(e) {
            var user_id = $(this).data('user_id');
            e.preventDefault();
            $.ajax({
                url: '{{ route('admin.users.showDetails') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: user_id
                },
                success: function(data) {
                    $('#user_detail_user_id').val(data.user_id || '');
                    $('#user_first_name').text(data.first_name || '');
                    $('#user_second_name').text(data.second_name || '');
                    $('#user_third_name').text(data.third_name || '');
                    $('#user_last_name').text(data.last_name || '');
                    $('#user_birth_date').text(data.birth_date || '');
                    $('#user_id_number').text(data.id_number || '');


                    $('#user_identity_image').attr('src', data.identity_image_url ||
                        '{{ asset('assets/default-user.png') }}');
                    let statusText = '';
                    switch (parseInt(data.is_verifivation)) {
                        case 0:
                            statusText = 'لم يتم ارسال طلب';
                            break;
                        case 1:
                            statusText = 'مقبول';
                            break;
                        case 2:
                            statusText = 'قيد الانتظار';
                            break;
                        case 3:
                            statusText = 'مرفوض';
                            break;
                        default:
                            statusText = 'غير معروف';
                    }
                    $('#user_verification_status').text(statusText);
                    $('#userDetailsModal').modal('show');
                },
                error: function() {
                    alert('حدث خطأ أثناء جلب بيانات المستخدم');
                }
            });

            $('#userDetailsModal').modal('show');
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


        $(document).on("click", '.release', function() {
            let deskMagmentId = $(this).data("id");
            $('#release_desk_mangement_id').val(deskMagmentId);

            code = $(this).data("code"); // Note: data- should be replaced with data-code in the button
            $("#deskCode").text(code);
            $("#releaseModal").modal("show");
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
                        $('.release_block').hide();
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

    

    </script>
