<script>
    function loadInvoiceTable(params = {}) {
        if ($.fn.DataTable.isDataTable('#invoice_table')) {
            $('#invoice_table').DataTable().clear().destroy();
        }

        $('#invoice_table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('admin.invoices.getIndex') }}",
                type: 'get',
                data: function(d) {
                    Object.assign(d, params); // دمج جميع الـ params مع الطلب
                },
                dataSrc: function(response) {
                    $('#total_amount').text("(" + response.total_amount + ")");
                    $('#invoice_count').text("(" + response.invoice_count + ")");
                    $('#paid_amount').text("(" + response.paid_amount + ")");
                    $('#not_paid_amount').text("(" + response.not_paid_amount + ")");
                    return response.data;
                }
            },
            columns: [{
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name',
                    searchable: true,
                    orderable: true

                },
                {
                    data: 'mobile',
                    name: 'users.mobile',
                    defaultContent: ''
                },
                {
                    data: 'branch',
                    name: 'users.branch.name',
                    defaultContent: '',
                    orderable: false
                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: false
                },
                {
                    data: 'expiration_date',
                    name: 'expiration_date',
                    orderable: false
                },
                {
                    data: 'due_date',
                    name: 'due_date',
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [8, 'desc']
            ], // الترتيب حسب created_at
            pageLength: 10,
            lengthMenu: [10, 50, 100, 250, 500],
            drawCallback: function() {
                KTMenu.createInstances();
            }
        });




    }

    function loadIncomeMovementTable(params = {}) {
        if ($.fn.DataTable.isDataTable('#income_movement_table')) {
            $('#income_movement_table').DataTable().clear().destroy();
        }

        $('#income_movement_table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('admin.incomeMovements.getIndex') }}",
                type: 'get',
                data: function(d) {
                    Object.assign(d, params); // دمج جميع الـ params مع الطلب
                },
                dataSrc: function(response) {
                    $('#income_movement_total_amount').text("(" + response.total_amount + ")");
                    $('#income_movement_count').text("(" + response.income_movement_count + ")");
                    $('#income_movement_min_amount').text("(" + response.min_amount + ")");
                    $('#income_movement_max_amount').text("(" + response.max_amount + ")");

                    return response.data;
                }
            },

            columns: [{
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'source',
                    name: 'source',
                    defaultContent: ''
                },
                {
                    data: 'amount',
                    name: 'amount',
                    orderable: false
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: false
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [4, 'desc']
            ], // الترتيب حسب created_at
            pageLength: 10,
            lengthMenu: [10, 50, 100, 250, 500],
            drawCallback: function() {
                KTMenu.createInstances();
            }
        });




    }


    
    function loadJobConstranctTable(params = {}) {
        if ($.fn.DataTable.isDataTable('#job_constanct_table')) {
            $('#job_constanct_table').DataTable().clear().destroy();
        }

        $('#job_constanct_table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('admin.jobConstrancts.getIndex') }}",
                type: 'get',
                data: function(d) {
                    Object.assign(d, params); // دمج جميع الـ params مع الطلب
                },
                dataSrc: function(response) {

                    $('#job_contranct_total_amount').text("(" + response.total_amount + ")");
                    $('#job_contranct_count').text("(" + response.job_constranct_count + ")");
                    $('#job_contranct_min_amount').text("(" + response.min_amount + ")");
                    $('#job_contranct_max_amount').text("(" + response.max_amount + ")");

                    return response.data;
                }
            },

            columns: [{
                    data: 'photo',
                    name: 'photo',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'user.name',
                    name: 'user.name',
                    defaultContent: '',
                    searchable: true,
                    orderable: true

                },
                {
                    data: 'user.mobile',
                    name: 'user.mobile',
                    defaultContent: '',
                    searchable: true,
                    orderable: true
                },
                {
                    data: 'sallary',
                    name: 'sallary',
                    searchable: true,
                    orderable: true

                },
                {
                    data: 'job_type',
                    name: 'job_type',
                    searchable: true,
                    orderable: true
                },

                {
                    data: 'duration',
                    name: 'duration',
                    searchable: true,
                    orderable: true
                },


                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [4, 'desc']
            ], // الترتيب حسب created_at
            pageLength: 30,
            lengthMenu: [30, 50, 100, 250, 500],
            drawCallback: function() {
                KTMenu.createInstances();
            }
        });




    }

    function loadLogTable(params = {}) {
        if ($.fn.DataTable.isDataTable('#log_table')) {
            $('#log_table').DataTable().clear().destroy();
        }
        $('#log_table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: "{{ route('admin.logs.getIndex') }}",
                type: 'get',
                data: function(d) {
                    Object.assign(d, params);
                },
                dataSrc: function(response) {
                    $('#user_count').text("(" + response.user_count + ")");
                    $('#presence_count').text("(" + response.presence_count + ")");
                    $('#log_hours').text("(" + response.log_hours + ")");
                    return response.data;
                }
            },
            columns: [{
                    data: 'photo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'users.name'
                },
                {
                    data: 'mobile',
                    name: 'users.mobile'
                },
                {
                    data: 'branch_name',
                    name: 'users.branch.name',
                    orderable: false
                },
                {
                    data: 'pendding_invoice',
                    name: 'pendding_invoice',
                    orderable: false
                },
                {
                    data: 'date',
                    name: 'date',
                    orderable: false
                },
                {
                    data: 'time_in',
                    name: 'time_in',
                    orderable: false
                },
                {
                    data: 'time_out',
                    name: 'time_out',
                    orderable: false
                },
                {
                    data: 'hours',
                    name: 'hours',
                    orderable: false
                },
                {
                    data: 'action',
                    orderable: false,
                    searchable: false
                }
            ],
            order: [
                [1, 'asc']
            ],
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100, 250, 500],
            drawCallback: function() {
                KTMenu.createInstances();
            }
        });




    }








    function exportWithFilters(buttonId, routeName, filters = {}) {
        $(buttonId).on('click', function(e) {
            e.preventDefault();

            console.log(filters);
            const url = new URL(routeName, window.location.origin);

            Object.entries(filters).forEach(([paramName, source]) => {
                let value;

                if (typeof source === 'string' && source.startsWith('#')) {
                    // إذا كان selector مثل "#input_id"
                    value = $(source).val();
                } else {
                    value = source;
                }

                if (value !== null && value !== undefined && value !== '') {
                    url.searchParams.set(paramName, value);
                }
            });


            window.location.href = url.toString();
        });
    }
</script>
