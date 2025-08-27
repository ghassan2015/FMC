    <script src="{{ asset('assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>

<script>

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
                            $('#exampleModal').modal('hide');

                        } else {
                            toastr.error(response.message, "Error!");

                        }

                        $('#spinner').hide();
                        $('.btn-primary').attr('disabled', false);
                        $('.hiden_icon').show();

                        setTimeout(() => {
                        window.location.href="{{route('admin.doctors.index')}}"

                        }, 2000);

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

        $(document).ready(function() {
    let days = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];

    function generateScheduleTable(branchId, branchName) {
        let html = `<div class="branch-schedule mt-4" id="branchSchedule${branchId}">
                        <h5>مواعيد الدكتور في فرع: ${branchName}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>اليوم</th>
                                    <th>من</th>
                                    <th>إلى</th>
                                    <th>مدة الجلسة (دقائق)</th>
                                </tr>
                            </thead>
                            <tbody>`;
        days.forEach(day => {
            html += `<tr>
                        <td>${day}</td>
                        <td><input type="time" name="schedule[${branchId}][${day}][start]" class="form-control"></td>
                        <td><input type="time" name="schedule[${branchId}][${day}][end]" class="form-control"></td>
                        <td><input type="number" name="schedule[${branchId}][${day}][session_duration]" class="form-control" value="30"></td>
                    </tr>`;
        });
        html += `   </tbody>
                    </table>
                    <hr>
                </div>`;
        return html;
    }

    $('#branchesSelect').change(function() {
        $('#branchSchedulesContainer').empty();
        let selected = $(this).val();
        selected.forEach(branchId => {
            let branchName = $('#branchesSelect option[value="'+branchId+'"]').text();
            $('#branchSchedulesContainer').append(generateScheduleTable(branchId, branchName));
        });
    });
});

</script>
