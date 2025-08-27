<script>
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).data('name_delete');
        var ids = $(this).data('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit_delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();

        $.ajax({
            url: '{{ route('admin.doctors.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                toastr.success(response.message, "{{ __('label.process_success') }}");
                $('.data-table').DataTable().ajax.reload();
            },
            error: function(response) {
                toastr.error(response.message, "{{ __('label.process_fail') }}");
                $('.data-table').DataTable().ajax.reload();
            }
        });
    });



    // Redraw table on filter select change
    $('#branchFilter, #roleFilter, #isActiveFilter,#specializationFilter').on('change', function() {
        $('.data-table').DataTable().draw(true);
    });

    // Redraw table on search input keyup
    $('[data-kt-docs-table-filter="search"]').on('keyup', function() {


        $('#kt_datatable_example_1').DataTable().search(this.value).draw();
    });
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,

        ajax: {
            url: "{{ route('admin.doctors.getIndex') }}",
            type: 'get',
            data: function(d) {
                d.branch_id = $('#branchFilter').val();
                d.role_id = $('#roleFilter').val();
                d.is_active = $('#isActiveFilter').val();
                d.specialization_id = $('#specializationFilter').val();
                d.search = $('[data-kt-docs-table-filter="search"]').val();

            },
        },

        columns: [


            {
                data: 'photo',
                name: 'photo',
                orderable: false
            },
            {
                data: 'name',
                name: 'name',
                orderable: false
            },
            {
                data: 'mobile',
                name: 'mobile',
                orderable: false
            },
            {
                data: 'email',
                name: 'email',
                orderable: false
            },

            {
                data: 'specializations.name',
                name: 'specializations',
                orderable: false,
                defaultContent: '-',
                render: function(data, type, row) {
                    return data ? (data.ar || data.en || '-') : '-';
                }
                // هذه القيمة تظهر إذا كانت البيانات فارغة أو null
            },

            @can('update_status_doctor')


                {
                    data: 'is_active',
                    name: 'is_active',
                    orderable: false
                },
            @endcan {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        drawCallback: function() {
            KTMenu.createInstances();
        }

        // language: {
        //     "url":
        // }
    });

    table.on('preXhr.dt', function() {
        $('#datatable-loader').show(); // إظهار الـ spinner قبل جلب البيانات
    });

    table.on('xhr.dt', function() {
        $('#datatable-loader').hide(); // إخفاء الـ spinner بعد جلب البيانات
    });


    // Remove inline onchange and handle status toggle via delegated event
    $(document).on('change', '.check_status', function(event) {
        event.preventDefault();

        var _this = $(this);
        var doctor_id = _this.data('id');
        var is_active = _this.prop('checked') ? 1 : 0;


        $.ajax({
            url: '{{ route('admin.doctors.updateStatus') }}',
            method: 'POST',
            data: {
                "doctor_id": doctor_id,
                "is_active": is_active,
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                if (response.status == 201) {
                    toastr.success(response.message, "{{ __('label.success') }}");

                } else {
                    toastr.error(response.message, "{{ __('label.process_fail') }}");

                }
                $('.data-table').DataTable().ajax.reload(null, false);

            },
            error: function(data) {

                toastr.error(data.responseJSON && data.responseJSON.message ?
                    data.responseJSON.message : 'حدث خطأ ما', "{{ __('label.process_fail') }}");

                $('.data-table').DataTable().ajax.reload(null, false);
            }
        });

    });



    function toggleFilter() {
        const filterSection = document.getElementById("filter-section");
        filterSection.classList.toggle("d-none");
    }


    $(document).on('click', '.appointment', function(e) {
        e.preventDefault();
        let doctorId = $(this).data('doctor_id');

        $('#doctorId').val(doctorId);
        $('#branchSelect').empty();
        $('#availableTimes').empty();

        // تحميل الفروع الخاصة بالدكتور
        $.get('{{ route('admin.doctors.getBranches') }}', {
            doctor_id: doctorId
        }, function(branches) {
            $('#branchSelect').append('<option value="">اختر الفرع</option>');
            branches.forEach(branch => {
                let locale = "{{ app()->getLocale() }}";
                let branchName = branch.name[locale] || branch.name['en'];
                $('#branchSelect').append(
                    `<option value="${branch.id}">${branchName}</option>`);
            });
            $('#appointmentModal').modal('show');
        });
    });

    // عند اختيار الفرع أو التاريخ → جلب المواعيد المتاحة
    $('#branchSelect, #appointmentDate').change(function() {
        let doctorId = $('#doctorId').val();
        let branchId = $('#branchSelect').val();
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
                        '<span class="text-danger">لا توجد مواعيد متاحة</span>');
                } else {
                    times.forEach(time => {
                        $('#availableTimes').append(
                            `<button type="button" class="btn btn-outline-primary m-1">${time}</button>`
                        );
                    });
                }
            });
        }
    });
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
    $("#my-form").validate({

        rules: {






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
                        $('#appointmentModal').modal('hide');

                    } else {
                        toastr.error(response.message, "Error!");

                    }

                    $('#spinner').hide();
                    $('.btn-primary').attr('disabled', false);
                    $('.hiden_icon').show();
                    if (typeof table !== 'undefined') {
                        $('.data-table').ajax.reload(null, false); // false = keep current page
                    }




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

    // Export Excel functionality
</script>
