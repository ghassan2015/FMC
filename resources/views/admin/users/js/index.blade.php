    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif


    <script>
        $('[data-kt-docs-table-filter="search"]').on('keyup', function() {
            $('.data-table').DataTable().search(this.value).draw();
        });

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


                    },
                },
                columns: [{
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        width: '60px'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: false,
                        width: '60px'

                    },
                    {
                        data: 'id_number',
                        name: 'id_number',
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



        });












    </script>
