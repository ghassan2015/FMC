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
                url: '{{ route('admin.banners.delete') }}',
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
                url: "{{ route('admin.banners.getIndex') }}",
                type: 'get',
                data: function(d) {
                    d.is_active = $('#isActiveFilter').val();
                    d.search = $('[data-kt-docs-table-filter="search"]').val();
                },
            },

            columns: [

                {
                    data: 'photo',
                    name: 'photo',
                    orderable: false,
                    searchable: true,

                },
                {
                    data: 'title',
                    name: 'title',
                    orderable: false,
                    searchable: true,

                },

                @if(auth('admin')->user()->can('update_status_service'))
                {
                    data: 'is_active',
                    name: 'is_active',
                    orderable: false,
                    searchable: true,

                },

                @endcan
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
                url: '{{ route('admin.banners.updateStatus') }}',
                method: 'POST',
                data: {
                    "banner_id": ids,
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






        $(document).on('click', '.add_banner', function() {
            $('#exampleModal').modal('show');

            let _url = "{{ route('admin.banners.store') }}";
                $('#logoPreview').css('background-image', 'url(' + '{{ asset('assets/default.png') }}' + ')');

            $('#my-form')[0].reset();

            $('#my-form').attr('action', _url);
            $('#status').prop('checked', true);



        });





        $(document).on('click', '.edit', function() {
            let button = $(this);
            // ملء الحقول
            $('#banner_id').val(button.data('banner_id'));
            $('#title_ar').val(button.data('title_ar'));
            $('#title_en').val(button.data('title_en'));
            $('#description_ar').val(button.data('description_ar'));
            $('#description_en').val(button.data('description_en'));
            $('#is_active').prop('checked', button.data('is_active'));
            // تحديث صورة الغلاف
            let photo = button.data('photo');
            if (photo) {
                $('#logoPreview').css('background-image', 'url(' + photo + ')');

            }

            $('#my-form').attr('action', "{{ route('admin.banners.update') }}");
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
                                "{{ __('message.successfully_process') }}");
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
                            if (response.status) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.message,
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }
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
