<script>
    // Redraw table on search input keyup
    $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
        $('.data-table').DataTable().search(this.value).draw();
    });

    //


    table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: true,

        ajax: {
            url: "{{ route('admin.activities.getIndex') }}",
            type: 'get',
            data: function(d) {
                d.admin_id = $('#search_admin_id').val();
                d.start_date = $('#serach_start_date').val();
                d.end_date = $('#search_end_date').val();
                d.search = $('[data-kt-docs-table-filter="search"]').val();
            },
        },

        columns: [

            {
                data: 'log_name',
                name: 'log_name'
            },
            {
                data: 'description',
                name: 'description'
            },
            {
                data: 'causer',
                name: 'causer'
            },
            {
                data: 'created_at',
                name: 'created_at'
            }

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

    $('#search_admin_id, #search_end_date, #serach_start_date').on('change', function() {
        table.ajax.reload();
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
