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
                d.specialization_id=$('#specializationFilter').val();
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

    // مثال بسيط للتعامل مع البحث (يمكن تطويره لاحقاً ليتصل بـ DataTable مثلاً)


    document.getElementById("roleFilter").addEventListener("change", function() {
        let role = this.value;
        // ضع هنا فلترة الجدول مثلاً
    });

    // Export Excel functionality
</script>
