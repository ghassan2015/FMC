    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif


    <script>
        $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
            $('.data-table').DataTable().search(this.value).draw();
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
                    url: "{{ route('admin.users.getIndex') }}",
                    type: 'get',
                    data: function(d) {
                        d.status = $('#search_statuses').val();
                        d.displacement_place = $('#search_displacement_place').val();
                        d.branch_id = $('#search_branch_id').val();
                        d.user_type_cd_id = $('#search_user_type_cd_id').val();
                        d.workplace_attendance = $('#search_workplace_attendance').val();


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
                        data: 'branch_name',
                        name: 'branch_name',
                        orderable: false,
                        orderable: false,
                        width: '60px'

                    },
                    {
                        data: 'total_invoice',
                        name: 'total_invoice',
                        orderable: true,
                        orderable: false,
                        width: '60px'

                    },
                    {
                        data: 'mobile',
                        name: 'mobile',
                        searchable: true,
                        visible: false

                    },
                    {
                        data: 'email',
                        name: 'email',
                        visible: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        visible: false
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
                        data: 'total_work_hours',
                        name: 'total_work_hours',
                        orderable: true
                    },
                    {
                        data: 'placement_date',
                        name: 'placement_date',
                        orderable: true
                    },
                    {
                        data: 'code_internet',
                        name: 'code_internet',
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

            table.column(5).visible(false); // Hides the "office" column
            table.column(6).visible(false); // Hides the "office" column
            table.column(7).visible(false);


            $('#exportExcelBtn').on('click', function(e) {
                e.preventDefault();
                const url = new URL("{{ route('admin.users.excelExport') }}", window.location.origin);
                url.searchParams.set('search', $('[data-kt-docs-table-filter="search"]').val());
                url.searchParams.set('status', $('#search_statuses').val());
                url.searchParams.set('displacement_place', $('#search_displacement_place').val());
                url.searchParams.set('branch_id', $('#search_branch_id').val());
                url.searchParams.set('user_type_cd_id', $('#search_user_type_cd_id').val());
                url.searchParams.set('workplace_attendance', $('#search_workplace_attendance').val());


                // فتح الرابط للتنزيل
                window.location.href = url.toString();
            });

            // Export PDF functionality
            $('#exportPdfBtn').on('click', function(e) {
                e.preventDefault();


                // إعداد رابط التصدير مع الفلاتر
                const url = new URL("{{ route('admin.users.pdfExport') }}", window.location.origin);
                url.searchParams.set('search', $('[data-kt-docs-table-filter="search"]').val());
                url.searchParams.set('status', $('#search_statuses').val());
                url.searchParams.set('displacement_place', $('#search_displacement_place').val());
                url.searchParams.set('branch_id', $('#search_branch_id').val());
                url.searchParams.set('user_type_cd_id', $('#search_user_type_cd_id').val());
                url.searchParams.set('workplace_attendance', $('#search_workplace_attendance').val());


                // فتح الرابط للتنزيل
                window.location.href = url.toString();
            });

            $(document).on('click', '.internet_subscription', function(e) {
                e.preventDefault();
                var user_id = $(this).data('user_id');
                $('#internet_user_id').val(user_id);
                $('#internetSubscriptionModal').modal('show')
            });




            $(document).on('click', '.show_id_photo', function(e) {
                e.preventDefault();
                var photoUrl = $(this).data('photo');
                $('#modalIdPhoto').attr('src', photoUrl);
                $('#idPhotoModal').modal('show');
            });

            $('.verification-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: {
                    url: "{{ route('admin.users.getVerification') }}",
                    type: 'get',

                },
                columns: [{
                        data: 'photo',
                        name: 'photo',
                        orderable: false
                    },
                    {
                        data: 'full_name',
                        name: 'full_name',
                        orderable: false
                    },
                    {
                        data: 'id_number',
                        name: 'id_number',
                        orderable: false
                    },
                    {
                        data: 'birth_date',
                        name: 'birth_date',
                        orderable: false
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },








                ],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                }
            });

            $(document).on('click', '.edit_verification_user', function(e) {
                e.preventDefault();
                var user_id = $(this).data('user_id');
                $('#edit_verification_user_id').val(user_id);
                $('#acceptStatusModal').modal('show');
            });
            // Listen for changes on the new search filters and reload the DataTable
            $('#search_displacement_place, #search_branch_id, #search_statuses, #serach_user_type_cd_id, #search_workplace_attendance')
                .on('change', function() {
                    $('.data-table').DataTable().ajax.reload();
                });







            $("form[name='exemption-form']").validate({
                rules: {
                    message: {
                        required: true
                    },


                },
                messages: {



                },
                submitHandler: function(form) {
                    var $button = $(form).find('button[type="submit"]');
                    var $spinner = $button.find('.spinner-border');

                    // Show spinner
                    $spinner.show();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    var data = new FormData(document.getElementById("exemption-form"));
                    $('#spinner').show();
                    $('.btn-primary').attr('disabled', true);
                    $('.hiden_icon').hide();
                    $.ajax({
                        url: '',
                        type: "POST",
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            // Hide spinner
                            $('#spinner').hide();
                            $('.btn-primary').attr('disabled', false);
                            $('.hiden_icon').show();
                            // $('.data-table').DataTable().draw(true);
                            $('#exemptionModal').modal('hide')

                            if (response.status) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                });

                            }
                        },
                        error: function(response) {
                            // Hide spinner
                            $('#spinner').hide();
                            $('.btn-primary').attr('disabled', false);
                            $('.hiden_icon').show();
                            response.responseJSON;
                            var errors = response.responseJSON.errors;
                            if (errors) {
                                var errorText = "";
                                $.each(errors, function(key, value) {
                                    errorText += value + "\n";
                                    $('.' + key).text(value);
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: response.responseJSON['message'],
                                });
                            }
                        }
                    });
                }
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



        let serviceTable = null;


        $(document).on('click', '.add_service', function(e) {
            e.preventDefault();
            let userId = $(this).data('user_id');

            loadAvailableServices(userId);
            // Open the modal for adding a service
            $('#add_edit_service_user_id').val(userId);
            $('#add_edit_service_id').val(null).trigger('change');
            $('#addServiceModal').modal('show');
        });


        $("#addServiceForm").validate({
            rules: {
                service_id: {
                    required: true
                },
                quantity: {
                    required: true,
                    number: true,
                    min: 1
                },
            },
            messages: {
                service_id: "يرجى اختيار الخدمة",
                quantity: "يرجى إدخال الكمية بشكل صحيح",
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let formData = new FormData(form);
                $('#send_form').html('جاري الإرسال...');

                $.ajax({
                    url: '{{ route('admin.users.addService') }}',
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {
                        toastr.success(response.message, '', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 3000,
                        });

                        $('#addServiceModal').modal('hide');
                        $('#service_table_list').DataTable().ajax.reload(null, false);
                        $('#send_form').html('إرسال');
                    },

                    error: function(xhr) {
                        let errorText = "";

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                errorText += value + "\n";
                            });
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorText = xhr.responseJSON.message;
                        } else {
                            errorText = "حدث خطأ غير معروف، يرجى المحاولة لاحقاً.";
                        }

                        toastr.error(errorText, 'خطأ', {
                            closeButton: true,
                            progressBar: true,
                            timeOut: 5000,
                        });

                        $('#send_form').html('إرسال');
                    }
                });
            }
        });

function loadAvailableServices(userId) {
    let $select = $('#add_edit_service_id');
    let $loading = $('#loadingService');

    $.ajax({
        url: "{{ route('admin.users.getAvailableServices') }}",
        type: 'GET',
        data: { user_id: userId },

        beforeSend: function() {
            // أظهر أيقونة التحميل
            $loading.show();

            // أفرغ الـ select قبل إرسال الطلب
            $select.empty();
            $select.append('<option value="">{{ __("label.selected") }}</option>');

     
        },

        success: function(data) {
            if (data.length === 0) {
                $select.append('<option disabled>لا توجد خدمات متاحة</option>');
            } else {
                $.each(data, function(index, service) {
                    $select.append(`<option value="${service.id}">${service.name}</option>`);
                });
            }
            if ($select.hasClass('select2-hidden-accessible')) {
                $select.trigger('change');
            }
        },

        error: function() {
            alert('حدث خطأ أثناء جلب الخدمات المتاحة');
        },

        complete: function() {
            // أخفِ أيقونة التحميل عند انتهاء الطلب
            $loading.hide();
        }
    });
}



        $(document).on('change', '#add_edit_quantity', function(e) {
            e.preventDefault();
            let serviceId = $('#add_edit_service_id').val();
            let quantity = $(this).val();
            let start_date = $('#add_edit_service_start_date').val();
            let end_date = $('#add_edit_service_end_date').val();

            $.ajax({
                url: '{{ route('admin.users.getAmount') }}',
                type: 'POST',
                data: {
                    service_id: serviceId,
                    quantity: quantity,
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 200) {


                        $('#add_edit_service_amount').val(response.total_amount);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while calculating the amount.',
                    });
                }
            });
        });

        let delete_service_url = "";
        $(document).on('click', '.delete_service', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('show')
            var name_delete = $(this).data('name_delete');
            var ids = $(this).data('id');
            $('#Delete_id').val(ids);
            delete_user_url = "{{ route('admin.users.deleteService') }}";
            $('.submit_delete').attr('id', 'delete_user_service');

            $('#Name_Delete').val(name_delete);

        });

        $(document).on('click', '#delete_user_service', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('hide');

            var ids = $('#Delete_id').val();
            $.ajax({
                url: delete_user_url,
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
                    $('#service_table_list').DataTable().ajax.reload(null, false);



                },
                error: function(data) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#service_table_list').DataTable().ajax.reload(null, false);

                }


            });




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



        $(document).on('click', '.show-photo-modal', function() {
            var photo = $(this).data('photo');
            $('#modalPhoto').attr('src', photo);
            $('#photoModal').modal('show');
        });

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














        $("form[name='userDetails-form']").validate({
            rules: {
                is_verification: {
                    required: true,
                },
            },

            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData(document.getElementById("userDetails-form"));

                $.ajax({
                    url: '{{ route('admin.users.postVerification') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    beforeSend: function() {
                        $('#send_form').attr('disabled', true).html(
                            '<i class="fa fa-spinner fa-spin"></i> جاري الإرسال...');
                    },

                    success: function(response) {
                        toastr.success(response.message, 'تم بنجاح', {
                            timeOut: 2000
                        });
                        $('#userDetailsModal').modal('hide');
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
                        $('#send_form').attr('disabled', false).html(
                            '<i class="fa fa-paper-plane"></i> إرسال');
                    }
                });
            }
        });









        $("form[name='add-work-space']").validate({
            // Specify validation rules
            rules: {



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

                var data = new FormData(document.getElementById("add-work-space"));


                $('#send_form').html('Sending..');
                $.ajax({
                    url: '{{ route('admin.users.addToWorkSpace') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,

                    success: function(response) {


                        if (response.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                        }

                        $('#addWorkSpaceModal').modal('hide');

                        $('.data-table').DataTable().ajax.reload(null, false);
                    },
                    error: function(response) {





                        var errors = response.responseJSON.errors;
                        var errorText = "";
                        $.each(errors, function(key, value) {
                            errorText += value + "\n";
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Failed',
                            text: errorText
                        });



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





        let delete_user_url = "";
        $(document).on('click', '.delete_user', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('show')
            var name_delete = $(this).data('name_delete');
            var ids = $(this).data('id');
            $('#Delete_id').val(ids);
            delete_user_url = "{{ route('admin.users.delete') }}";
            $('.submit_delete').attr('id', 'delete_user');

            $('#Name_Delete').val(name_delete);

        });

        $(document).on('click', '#delete_user', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('hide');

            var ids = $('#Delete_id').val();
            $.ajax({
                url: delete_user_url,
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
                    $('#kt_datatable_example_1').DataTable().ajax.reload(null, false);

                }


            });




        });


        $("form[name='my-single-invoice']").validate({
            rules: {

                amount: {
                    required: true
                },


                expiration_date: {
                    required: true,

                },

                due_date: {
                    required: true,

                }

            },
            messages: {

                amount: {
                    required: "{{ __('validation.ammount_required') }}"
                },


            },
            submitHandler: function(form) {
                var $button = $(form).find('button[type="submit"]');
                var $spinner = $button.find('.spinner-border');

                // Show spinner
                $spinner.show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = new FormData(document.getElementById("my-single-invoice"));
                var actionUrl = form.getAttribute(
                    "action"); // الحصول على الرابط من الخاصية action في الفورم


                $('#spinner').show();
                $('.btn-primary').attr('disabled', true);
                $('.hiden_icon').hide();
                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        // Hide spinner
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        $('.data-table').DataTable().ajax.reload(null, false);
                        $('#invoiceSingleModal').modal('hide')

                        if (response.status) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });

                        }
                    },
                    error: function(response) {
                        // Hide spinner
                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();
                        response.responseJSON;
                        var errors = response.responseJSON.errors;
                        if (errors) {
                            var errorText = "";
                            $.each(errors, function(key, value) {
                                errorText += value + "\n";
                                $('.' + key).text(value);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.responseJSON['message'],
                            });
                        }
                    }
                });
            }
        });



        $(document).on('click', '.sendSms', function() {
            // Optionally, set dynamic values if needed
            var userId = $(this).data('user_id'); // Get dynamic invoice ID

            $('#invoice_user_id').val(userId); // Set invoice ID to the hidden input field

            $('#exemptionModal').modal('show');
        });
    </script>
