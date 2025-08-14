@extends('admin.layouts.master')

@section('title', __('label.reports'))
@section('toolbarSubTitle', __('label.report_list'))
@section('toolbarPage', __('label.display_all_report_list'))


@push('styles')
    <style>
        .report-card.active {
            background-color: #0a8ee7;
            /* لون أزرق */
            border: 2px solid #007bff;
            transition: 0.3s;
            color: white;
        }

        .report-card.active .card-title {
            color: white;
        }



        .report-card.active i {
            color: white !important;
        }
    </style>
@endpush
@section('content')

    <div class="row mb-4 mt-6 gx-5 gx-xl-10 ">
        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="user">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="{{ asset('assets/profile-2user.svg') }}">


                    </div>
                    <h5 class="card-title fw-bold">تقرير المستخدم</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="attendance">
                <div class="card-body">
                    <div class="mb-2">

                        <img src="{{ asset('assets/clock.svg') }}">
                    </div>
                    <h5 class="card-title fw-bold">تقرير الحضور والانصراف</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="dues">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="{{ asset('assets/money-3.svg') }}">
                    </div>
                    <h5 class="card-title fw-bold">تقرير المستحقات المالية</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="daily">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="{{ asset('assets/calendar.svg') }}">
                    </div>
                    <h5 class="card-title fw-bold">تقرير الحركة اليومية</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="transactions">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="{{ asset('assets/chart-square.svg') }}">

                    </div>
                    <h5 class="card-title fw-bold">حركة المالية للمستخدم</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card report-card text-center shadow-sm border-0  cursor-pointer hover-card" data-tab="branches">
                <div class="card-body">
                    <div class="mb-2">
                        <img src="{{ asset('assets/buildings-2.svg') }}" style="color:#071437">

                    </div>
                    <h5 class="card-title fw-bold">تقرير الفروع</h5>
                </div>
            </div>
        </div>



        <div id="report-tabs" class=" p-4 rounded ">
            <div class="report-tab" id="tab-user" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/profile-2user.svg') }}"> تقرير المستخدم</h4>
                <div class="row mb-4 gx-5 gx-xl-10">


                    <div class="col-lg-3 col-sm-12 mb-3 ">
                        <label for="invoice_user_id" class="form-label fw-bold">{{ __('label.users') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="invoice_user_id">
                            <option value="">{{ __('label.all_users') }}</option>

                            @foreach ($users as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3 ">
                        <label for="invoice_branch_id" class="form-label fw-bold">{{ __('label.branch') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="invoice_branch_id">
                            <option value="">{{ __('label.all_branches') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <label for="invoice_start_date" class="form-label fw-bold">{{ __('label.start_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly
                                name="search_invoice_start_date" id="invoice_start_date" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <label for="invoice_end_date" class="form-label fw-bold">{{ __('label.end_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly name="invoice_end_date"
                                id="invoice_end_date" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-invoice-btn" data-type="pdf"
                            id="exportInvoicePdfBtn">
                            <i class="ki-duotone ki-file-pdf fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-invoice-btn" data-type="excel"
                            id="exportInvoiceExcelBtn">
                            <i class="ki-duotone ki-file-excel fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            {{ __('label.export_excel') }}
                        </button>

                    </div>
                </div>
            </div>

            <div class="report-tab" id="tab-attendance" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/clock.svg') }}">
                    تقرير الحضور والانصراف</h4>
                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-lg-4 col-sm-12 mb-3 search_branch">
                        <label for="attendance_user_id" class="form-label fw-bold">{{ __('label.users') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="attendance_user_id">
                            <option value="">{{ __('label.all_users') }}</option>

                            @foreach ($users as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-3 search_branch">
                        <label for="attendance_branch_id" class="form-label fw-bold">{{ __('label.branch') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="attendance_branch_id">
                            <option value="">{{ __('label.all_branches') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="attendance_date" class="form-label fw-bold">{{ __('label.date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly name="attendance_date"
                                id="attendance_date" placeholder="" required />
                        </div>
                    </div>


                </div>
                <div class="row mb-4 gx-5 gx-xl-10">


                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-attendance-btn"
                            data-type="pdf">
                            <i class="ki-duotone ki-file-pdf fs-1"></i> {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-attendance-btn"
                            data-type="excel">
                            <i class="ki-duotone ki-file-excel fs-1"></i> {{ __('label.export_excel') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="report-tab" id="tab-dues" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/money-3.svg') }}">
                    تقرير المستحقات المالية</h4>

                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-lg-6 col-sm-12 mb-3 search_branch">
                        <label for="due_user_id" class="form-label fw-bold">{{ __('label.users') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="due_user_id">
                            <option value="">{{ __('label.all_users') }}</option>

                            @foreach ($users as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-sm-12 mb-3 search_branch">
                        <label for="due__branch_id" class="form-label fw-bold">{{ __('label.branch') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="due_branch_id">
                            <option value="">{{ __('label.all_branches') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                </div>
                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-due-btn" data-type="pdf">
                            <i class="ki-duotone ki-file-pdf fs-1"></i> {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-due-btn" data-type="excel">
                            <i class="ki-duotone ki-file-excel fs-1"></i> {{ __('label.export_excel') }}
                        </button>

                    </div>
                </div>

            </div>

            <div class="report-tab" id="tab-daily" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/calendar.svg') }}">
                    تقرير الحركة اليومية</h4>
                <div class="row mb-4 gx-5 gx-xl-10">


                    <div class="col-lg-3 col-sm-12 mb-3 ">
                        <label for="daily_user_id" class="form-label fw-bold">{{ __('label.users') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="daily_user_id">
                            <option value="">{{ __('label.all_users') }}</option>

                            @foreach ($accounts as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3 ">
                        <label for="daily_branch_id" class="form-label fw-bold">{{ __('label.branch') }}</label>

                        <select class="form-select form-select-solid" data-control="select2" id="daily_branch_id">
                            <option value="">{{ __('label.all_branches') }}</option>

                            @foreach ($branches as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <label for="daily_start_date" class="form-label fw-bold">{{ __('label.start_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly name="daily_start_date"
                                id="daily_start_date" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-12 mb-3">
                        <label for="daily_end_date" class="form-label fw-bold">{{ __('label.end_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly name="daily_end_date"
                                id="daily_end_date" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-daily-btn" data-type="pdf">
                            <i class="ki-duotone ki-file-pdf fs-1"></i> {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-daily-btn"
                            data-type="excel">
                            <i class="ki-duotone ki-file-excel fs-1"></i> {{ __('label.export_excel') }}
                        </button>
                    </div>
                </div>

            </div>

            <div class="report-tab" id="tab-transactions" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/chart-square.svg') }}">
                    حركة المالية للمستخدم</h4>
                <div class="row mb-4 gx-5 gx-xl-10">


                    <div class="col-lg-4 col-sm-12 mb-3 ">
                        <label for="transactions_user_id" class="form-label fw-bold">{{ __('label.users') }}</label>

                        <select class="form-select form-select-solid" data-control="select2"
                            id="transactions_account_id">
                            <option value="">{{ __('label.all_account') }}</option>

                            @foreach ($accounts as $value)
                                <option value="{{ $value->id }}">
                                    {{ $value->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="transactions_start_date"
                            class="form-label fw-bold">{{ __('label.start_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly
                                name="transactions_start_date" id="transactions_start_date" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 mb-3">
                        <label for="transactions_end_date" class="form-label fw-bold">{{ __('label.end_date') }}</label>
                        <div class="input-group">
                            <input type="text" class="form-control kt_datepicker" readonly
                                name="transactions_end_date" id="transactions_end_date" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-transactions-btn"
                            data-type="pdf">
                            <i class="ki-duotone ki-file-pdf fs-1"></i> {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-transactions-btn"
                            data-type="excel">
                            <i class="ki-duotone ki-file-excel fs-1"></i> {{ __('label.export_excel') }}
                        </button>

                    </div>
                </div>
            </div>

            <div class="report-tab" id="tab-branches" style="display:none;">
                <h4 class="mb-3"> <img src="{{ asset('assets/buildings-2.svg') }}" style="color: #071437">
                    تقرير الفروع</h4>

                <div class="row mb-4 gx-5 gx-xl-10">

                    <div class="col-12 col-md-6 d-flex gap-2 m-3">
                        <button type="button" class="btn btn-light-danger flex-fill export-branch-btn" data-type="pdf"
                            id="exportInvoicePdfBtn">
                            <i class="ki-duotone ki-file-pdf fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            {{ __('label.export_pdf') }}
                        </button>
                        <button type="button" class="btn btn-light-success flex-fill export-branch-btn"
                            data-type="excel" id="exportInvoiceExcelBtn">
                            <i class="ki-duotone ki-file-excel fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            {{ __('label.export_excel') }}
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        document.querySelectorAll('.report-card').forEach(card => {
            card.addEventListener('click', () => {
                let selected = card.getAttribute('data-tab');

                // إخفاء جميع التابات
                document.querySelectorAll('.report-tab').forEach(tab => {
                    tab.style.display = 'none';
                });

                // عرض التاب المختار
                document.getElementById('tab-' + selected).style.display = 'block';

                // إزالة class 'active' من جميع الكروت
                document.querySelectorAll('.report-card').forEach(c => {
                    c.classList.remove('active');
                });

                // إضافة class 'active' للكرت المختار
                card.classList.add('active');
            });
        });


        $(document).ready(function() {
            $('.export-daily-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);


                let daily_start_date = $('#daily_start_date').val();
                let daily_end_date = $('#daily_end_date').val()
                if (!daily_start_date) {
                    toastr.error('الرجاء ادخال تاريخ البداية للتقرير مطلوب', 'خطأ');
                    return;
                }
                if (!daily_end_date) {
                    toastr.error('الرجاء ادخال تاريخ الانتهاء للتقرير مطلوب ', 'خطأ');
                    return;
                }


                // تعطيل الزر وعرض أيقونة التحميل
                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    user_id: $('#daily_user_id').val(),
                    branch_id: $('#daily_branch_id').val(),
                    start_date: $('#daily_start_date').val(),
                    end_date: $('#daily_end_date').val(),
                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.daily.export') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        const disposition = xhr.getResponseHeader('Content-Disposition');
                        let filename = "report." + (data.type === "pdf" ? "pdf" : "xlsx");
                        if (disposition && disposition.indexOf('filename=') !== -1) {
                            filename = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(url);
                    },
                    error: function() {},
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });
            });
            $('.export-attendance-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);
                let attendanceDate = $('#attendance_date').val();
                let branch_id = $('#attendance_branch_id').val()
                if (!branch_id) {
                    toastr.error('الرجاء اختيار الفرع قبل التصدير', 'خطأ');
                    return;
                }
                if (!attendanceDate) {
                    toastr.error('الرجاء اختيار تاريخ قبل التصدير', 'خطأ');
                    return;
                }


                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    user_id: $('#attendance_user_id').val(),
                    branch_id: $('#attendance_branch_id').val(),
                    date: $('#attendance_date').val(),
                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.attendanceReport') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        const disposition = xhr.getResponseHeader('Content-Disposition');
                        let filename = "report." + (data.type === "pdf" ? "pdf" : "xlsx");
                        if (disposition && disposition.indexOf('filename=') !== -1) {
                            filename = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(url);
                    },
                    error: function() {},
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });

            });



            $('.export-transactions-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);

                // تعطيل الزر وعرض أيقونة التحميل
                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    account_id: $('#transactions_account_id').val(),
                    start_date: $('#transactions_start_date').val(),
                    end_date: $('#transactions_end_date').val(),
                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.transactions.export') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob' // مهم لتحميل ملف
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        let filename = "";
                        let disposition = xhr.getResponseHeader(
                            'Content-Disposition');
                        if (disposition && disposition.indexOf('filename=') !== -
                            1) {
                            filename = disposition.split('filename=')[1].replace(
                                /"/g, '');
                        } else {
                            filename = "report." + (data.type === "pdf" ? "pdf" :
                                "xlsx");
                        }

                        let link = document.createElement('a');
                        let url = window.URL.createObjectURL(response);
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    },
                    error: function(xhr) {},
                    complete: function() {
                        // إعادة الزر إلى حالته الأصلية وتمكينه
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });
            });

            $('.export-due-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);

                // تعطيل الزر وعرض أيقونة التحميل
                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    user_id: $('#due_user_id').val(),
                    branch_id: $('#due_branch_id').val(),
                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.dueReport.export') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        const disposition = xhr.getResponseHeader('Content-Disposition');
                        let filename = "report." + (data.type === "pdf" ? "pdf" : "xlsx");
                        if (disposition && disposition.indexOf('filename=') !== -1) {
                            filename = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(url);
                    },
                    error: function(xhr) {


                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });
            });


            $('.export-invoice-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);


                let invoice_start_date = $('#invoice_start_date').val();
                let invoice_end_date = $('#invoice_end_date').val()
                if (!invoice_start_date) {
                    toastr.error('الرجاء ادخال تاريخ البداية للتقرير مطلوب', 'خطأ');
                    return;
                }
                if (!invoice_end_date) {
                    toastr.error('الرجاء ادخال تاريخ الانتهاء للتقرير مطلوب ', 'خطأ');
                    return;
                }

                // تعطيل الزر وعرض أيقونة التحميل
                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    user_id: $('#invoice_user_id').val(),
                    branch_id: $('#invoice_branch_id').val(),
                    start_date: $('#invoice_start_date').val(),
                    end_date: $('#invoice_end_date').val(),

                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.InvoiceReport.export') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        const disposition = xhr.getResponseHeader('Content-Disposition');
                        let filename = "report." + (data.type === "pdf" ? "pdf" : "xlsx");
                        if (disposition && disposition.indexOf('filename=') !== -1) {
                            filename = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(url);
                    },
                    error: function(xhr) {


                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });
            });

            $('.export-branch-btn').on('click', function() {
                let exportType = $(this).data('type');
                let $btn = $(this);

                // تعطيل الزر وعرض أيقونة التحميل
                $btn.prop('disabled', true);
                let originalHtml = $btn.html();
                $btn.html(
                    '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>جارٍ التصدير...'
                );

                let data = {
                    user_id: $('#invoice_user_id').val(),
                    branch_id: $('#invoice_branch_id').val(),
                    start_date: $('#invoice_start_date').val(),
                    end_date: $('#invoice_end_date').val(),

                    type: exportType,
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('admin.reports.BranchReport.export') }}",
                    method: 'POST',
                    data: data,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response, status, xhr) {
                        const disposition = xhr.getResponseHeader('Content-Disposition');
                        let filename = "report." + (data.type === "pdf" ? "pdf" : "xlsx");
                        if (disposition && disposition.indexOf('filename=') !== -1) {
                            filename = disposition.split('filename=')[1].replace(/"/g, '');
                        }

                        const url = window.URL.createObjectURL(response);
                        const link = document.createElement('a');
                        link.href = url;
                        link.download = filename;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(url);
                    },
                    error: function(xhr) {


                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $btn.html(originalHtml);
                    }
                });
            });




        });
    </script>
@endpush
