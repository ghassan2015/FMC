    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

    @if (app()->getLocale() == 'ar')
        <script src="{{ asset('assets/js/messages_ar.min.js') }}"></script>
    @endif


<script>
    $('#kt_datatable_example_1').DataTable({
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
        order: [
            [0, 'desc']
        ],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        drawCallback: function() {
            KTMenu.createInstances();
        }



    });


    $(document).on('click', '.edit_verification_user', function(e) {
        e.preventDefault();
        var user_id = $(this).data('user_id');
        $('#edit_verification_user_id').val(user_id);
        $('#acceptStatusModal').modal('show');
    });


    $("form[name='acceptStatusForm']").validate({
        rules: {

            status: {
                required: true,

            },



        },


        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var data = new FormData(document.getElementById("acceptStatusForm"));


            $('#send_form').html('Sending..');
            $.ajax({
                url: '{{ route('admin.users.postVerification') }}',
                type: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,

                success: function(response) {


                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1000
                    });



                    $('#acceptStatusModal').modal('hide');

                    $('#kt_datatable_example_1').DataTable().ajax.reload(null, false);
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
</script>
