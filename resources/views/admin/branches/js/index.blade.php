    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif
    <script>
        // عند الضغط على زر الحذف
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('show');

            var name_delete = $(this).data('name_delete');
            var ids = $(this).data('id');

            $('#Delete_id').val(ids);
            $('#Name_Delete').val(name_delete);
        });

        // عند الضغط على زر التأكيد داخل المودال
        $(document).on('click', '.submit_delete', function(e) {
            e.preventDefault();

            $('#confirmModal').modal('hide');

            var ids = $('#Delete_id').val();

            $.ajax({
                url: '{{ route('admin.branches.delete') }}',
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
                url: "{{ route('admin.branches.getIndex') }}",
                type: 'get',
                data: function(d) {
                    d.is_active = $('#isActiveFilter').val();
                    d.search = $('[data-kt-docs-table-filter="search"]').val();
                },
            },

            columns: [{
                    data: 'name',
                    name: 'name',
                    orderable: false,
                    searchable: true,

                },



                {
                    data: 'address',
                    name: 'address',
                    orderable: false,
                    searchable: true,

                },



                @if(auth('admin')->user()->can('update_status_branch'))

                {
                    data: 'is_active',
                    name: 'is_active',
                    orderable: false,
                    searchable: true,

                },
                @endif
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


        // Remove inline onchange and handle status toggle via delegated event
      $(document).on('change', '.check_status', function(event) {
            event.preventDefault();

            var _this = $(this);
            var ids = _this.data('id');
            var is_active = _this.prop('checked') ? 1 : 0;


            $.ajax({
                url: '{{ route('admin.branches.updateStatus') }}',
                method: 'POST',
                data: {
                    "branch_id": ids,
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





        $(document).on('click', '.add_branch', function() {
            $('#exampleModal').modal('show');

            let _url = "{{ route('admin.branches.store') }}";

            $('#my-form')[0].reset();

            $('#my-form').attr('action', _url);
            $('#status').prop('checked', true);




        });





        $(document).on('click', '.edit', function() {
            let button = $(this);
            // ملء الحقول
            $('#branch_id').val(button.data('branch_id'));
            $('#name_ar').val(button.data('name_ar'));
            $('#name_en').val(button.data('name_en'));
            $('#address_ar').val(button.data('address_ar'));
            $('#address_en').val(button.data('address_en'));
            $('#is_active').prop('checked', button.data('is_active'));
            // تحديث صورة الغلاف
            let photo = button.data('photo');
            if (photo) {
                $('#logoPreview').css('background-image', 'url(' + photo + ')');

            }

            $('#my-form').attr('action', "{{ route('admin.branches.update') }}");
            // فتح المودال
            $('#exampleModal').modal('show');
        });



        $("#my-form").validate({

            rules: {
                name: {
                    required: true,

                },





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
                            $('#exampleModal').modal('hide');
                            $('.data-table').DataTable().ajax.reload()

                        } else {
                            toastr.error(response.message, "Error!");

                        }

                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();

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

        function toggleFilter() {
            const filterSection = document.getElementById("filter-section");
            filterSection.classList.toggle("d-none");
        }
        $('#exportExcelBtn').on('click', function(e) {
            e.preventDefault();

            const branch = $('#branchFilter').val();
            const is_active = $('#isActiveFilter').val();

            // إعداد رابط التصدير مع الفلاتر
            const url = new URL("{{ route('admin.branches.excelExport') }}", window.location.origin);
            url.searchParams.set('search', $('[data-kt-docs-table-filter="search"]').val());
            url.searchParams.set('is_active', is_active);

            // فتح الرابط للتنزيل
            window.location.href = url.toString();
        });

        // Export PDF functionality
        $('#exportPdfBtn').on('click', function(e) {
            e.preventDefault();


            const is_active = $('#isActiveFilter').val();
            // إعداد رابط التصدير مع الفلاتر
            const url = new URL("{{ route('admin.branches.pdfExport') }}", window.location.origin);
            url.searchParams.set('search', $('[data-kt-docs-table-filter="search"]').val());
            url.searchParams.set('is_active', is_active);

            // فتح الرابط للتنزيل
            window.location.href = url.toString();
        });
    </script>
