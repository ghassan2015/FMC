<script>
    $(document).on('click', '.delete', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('show')
        var name_delete = $(this).data('name_delete');
        var ids = $(this).data('id');
        $('#Delete_id').val(ids);
        $('#Name_Delete').val(name_delete);

    });

    $(document).on('click', '.submit', function(e) {
        e.preventDefault();

        $('#confirmModal').modal('hide');

        var ids = $('#Delete_id').val();
        $.ajax({
            url: '{{ route('admin.roles.delete') }}',
            method: 'POST',
            data: {
                "id": ids,
                "_token": "{{ csrf_token() }}",
            },
            success: function(data) {
                if (data.status === 201) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('.data-table').DataTable().ajax.reload();
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }



            },
            error: function(data) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: data,
                    showConfirmButton: false,
                    timer: 2000
                });
                $('.data-table').DataTable().ajax.reload();

            }


        });




    });





    // Redraw table on filter select change
    $('#isActiveFilter').on('change', function() {
        $('.data-table').DataTable().draw(true);
    });

    // Redraw table on search input keyup
    $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
        $('.data-table').DataTable().search(this.value).draw();
    });
    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,

        ajax: {
            url: "{{ route('admin.roles.getIndex') }}",
            type: 'get',
            data: function(d) {
                d.is_active = $('#isActiveFilter').val();
                d.search = $('[data-kt-docs-table-filter="search"]').val();
            },
        },

        columns: [

            {
                data: 'name',
                name: 'name',
                orderable: false
            },



            @can('update_status_roles')

            {
                data: 'status',
                name: 'status',
                orderable: false
            },
            @endcan
            {
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
        var ids = _this.data('id');
        var status = _this.prop('checked') ? 1 : 0;

        Swal.fire({
            title: "{{__('label.change_update_status')}}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '{{__('label.yes')}}',
            cancelButtonText: '{{__('label.cancel')}}',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('admin.roles.updateStatus') }}',
                    method: 'POST',
                    data: {
                        "id": ids,
                        "status": status,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        if (data.status == 201) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                        $('.data-table').DataTable().ajax.reload(null, false);

                    },
                    error: function(data) {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: data.responseJSON && data.responseJSON.message ?
                                data.responseJSON.message : 'حدث خطأ ما',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('.data-table').DataTable().ajax.reload(null, false);
                    }
                });
            } else {
                // Restore previous state if cancelled
                _this.prop('checked', !_this.prop('checked'));
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
</script>
