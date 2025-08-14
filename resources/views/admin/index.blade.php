@extends('admin.layouts.master')
@section('title', __('label.main'))

@section('toolbarSubTitle', __('label.statistics'))
@section('toolbarPage', __('label.general_statistics'))

@section('content')


    <div class="row gx-5 gx-xl-10">
        <div class="col-lg-3">
            <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                <div class="d-flex align-items-center mb-4">
                    <i class="fa-solid fa-users  me-3"></i>
                    <h6 class="mb-0"> المستخدمين</h6>
                </div>

                <!-- المحتوى الثلاثي -->
                <div class="d-flex justify-content-between w-100">
                    <div class="text-center">
                        <h6 class="mb-1">الإجمالي</h6>
                        <span class="fs-4 fw-bold">{{ $userCount }}</span>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-1">داخل الحاضنة</h6>
                        <span class="fs-4 fw-bold">{{ $insideCount }}</span>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-1">خارج الحاضنة</h6>
                        <span class="fs-4 fw-bold">{{ $outsideCount }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7 d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-solid fa-file-invoice-dollar  me-3"></i>
                    <h6 class="mb-0"> الفواتير</h6>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="text-center">
                        <h6 class="mb-1">الإجمالي</h6>
                        <span class="fs-4 fw-bold">{{ $total_invoice_amount }}</span>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-1">المدفوع</h6>
                        <span class="fs-4 fw-bold">{{ $total_invoice_paid_amount }}</span>
                    </div>
                    <div class="text-center">
                        <h6 class="mb-1">غير مدفوع</h6>
                        <span class="fs-4 fw-bold">{{ $total_invoice_non_paid_amount }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="col bg-light-success px-6 py-8 rounded-xl mb-7 d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-solid fa-clock  me-3"></i>
                    <h6 class="mb-0">الحركات المالية</h6>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="text-center">
                        <h6 class="mb-1">الإجمالي</h6>
                        <span class="fs-4 fw-bold">{{ $total_income_movment }}</span>
                    </div>

                    <div class="text-center">
                        <h6 class="mb-1">الشهر الحالي</h6>
                        <span class="fs-4 fw-bold">{{ $total_current_month_income_movment }}</span>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-3">
            <div class="col bg-light-warning px-6 py-8 rounded-xl mb-7 d-flex flex-column align-items-start">
                <div class="d-flex align-items-center mb-2">
                    <i class="fa-solid fa-file-contract  me-3"></i>
                    <h6 class="mb-0">اجمالي عقود العمل</h6>
                </div>
                <div class="d-flex justify-content-between w-100">
                    <div class="text-center">
                        <h6 class="mb-1">الإجمالي</h6>
                        <span class="fs-4 fw-bold">{{ $total_job_contracts }}</span>
                    </div>

                    <div class="text-center">
                        <h6 class="mb-1">الشهر الحالي</h6>
                        <span class="fs-4 fw-bold">{{ $total_current_month_job_contracts }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row gx-5 gx-xl-10">
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::Chart widget 27-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ $userCount }} </span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500">{{ __('label.user_by_branch_statistics') }}</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->

                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0 pb-1">
                    <canvas id="usersChart" width="400" height="400"></canvas>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 27-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::Chart widget 28-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2 total_invoice_amount"></span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span class="fs-6 fw-semibold text-gray-500 invoice_title"></span>
                        <!--end::Description-->
                    </div>
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                            <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">{{ __('label.actions') }}
                                </div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#"
                                    class="menu-link px-3 invoice_not_paid">{{ __('label.invoice_not_paid') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 invoice_paid">{{ __('label.invoice_paid') }}</a>
                            </div>

                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->

                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body d-flex align-items-end ps-4 pe-0 pb-4">
                    <!--begin::Chart-->

                    <canvas id="invoicesByBranchChart" height="100"></canvas>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Chart widget 28-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4 mb-5 mb-xl-10">
            <!--begin::List widget 9-->
            <div class="card card-flush h-xl-100">
                <!--begin::Header-->
                <div class="card-header py-7">
                    <!--begin::Statistics-->
                    <div class="m-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-2">
                            <!--begin::Title-->
                            <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ $total_income_movment }}</span>
                            <!--end::Title-->
                            <!--begin::Label-->
                            <!--end::Label-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <span
                            class="fs-6 fw-semibold text-gray-500">{{ __('label.total_month_income_movment') . $current_month }}</span>
                        <!--end::Description-->
                    </div>
                    <!--end::Statistics-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                            data-kt-menu-overflow="true">
                            <i class="ki-outline ki-dots-square fs-1 text-gray-500 me-n1"></i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Customer</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Contact</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body card-body d-flex justify-content-between flex-column pt-3">
                    <!--begin::Item-->
                    @foreach ($branchIncomes as $branchName => $data)
                        <div class="d-flex flex-stack">
                            <div class="d-flex align-items-center flex-stack flex-wrap flex-row-fluid d-grid gap-2">

                                {{-- اسم الفرع --}}
                                <div class="me-5 flex-shrink-0" style="min-width: 130px;">
                                    <a href="#"
                                        class="text-gray-600 fw-bold text-hover-primary fs-6 text-truncate d-inline-block"
                                        style="max-width: 130px;">
                                        {{ $branchName }}
                                    </a>
                                </div>

                                {{-- الدخل والنسبة --}}
                                <div class="d-flex align-items-center">
                                    <span class="text-gray-800 fw-bold fs-4 me-3">
                                        {{ number_format($data['current'], 2) }}
                                    </span>

                                    <div class="m-0">
                                        @php
                                            $change = $data['change'];
                                            $isUp = $change >= 0;
                                            $badgeClass = $isUp ? 'badge-light-success' : 'badge-light-danger';
                                            $icon = $isUp ? 'ki-arrow-up text-success' : 'ki-arrow-down text-danger';
                                        @endphp

                                        <span class="badge {{ $badgeClass }} fs-base">
                                            <i class="ki-outline {{ $icon }} fs-5 ms-n1"></i>
                                            {{ abs($change) }}%
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="separator separator-dashed my-3"></div>
                    @endforeach



                </div>
                <!--end::Body-->
            </div>
            <!--end::List widget 9-->
        </div>
        <!--end::Col-->
    </div>


    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!-- ✅ مخطط حالة الفواتير -->
        <div class="col-xxl-6 mb-5">
            <div class="card card-flush h-xl-100">
                <div class="card-header py-5">
                    <div>
                        <h3 class="fs-5 fw-bold mb-1">{{ __('label.invoices') }}</h3>
                        <span class="text-muted fs-6">{{ __('label.invoice_status') }}</span>
                    </div>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="invoiceStatusChart" style="width:100%; max-width:300px; height:300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- ✅ مخطط الفروع -->
        <div class="col-xxl-6 mb-5">
            <div class="card card-flush h-xl-100">
                <div class="card-header py-5">
                    <div>
                        <h3 class="fs-5 fw-bold mb-1">{{ __('label.branches') }}</h3>
                        <span class="text-muted fs-6">{{ __('label.branches_invoice_chart') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="branchChartCanvas" style="width:100%; height:300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- ✅ جدول الفواتير -->
        <div class="col-xxl-12 mb-5">
            <div class="card card-flush h-xl-100">
                <div class="card-header py-7">
                    <div class="m-0">
                        <h5 class="fs-6 fw-semibold text-gray-700">{{ __('label.invoice_list') }}</h5>
                        <span class="fs-6 fw-semibold text-gray-500">{{ __('label.display_all_invoice') }}</span>
                    </div>
                </div>
                <div class="card-body pt-3">
                    @include('components.invoice.table')
                </div>
            </div>
        </div>
    </div>









@endsection

@push('scripts')
    <script src="{{ asset('assets/js/widgets/charts/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/widgets/charts/chartjs.js') }}"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let invoiceChart;

        function loadInvoiceChart() {
            $.get("{{ route('admin.invoices.chartData') }}", function(response) {
                const invoiceStatusChart = document.getElementById('invoiceStatusChart').getContext('2d');

                if (invoiceChart) {
                    invoiceChart.destroy(); // لتجنب رسم مكرر
                }

                invoiceChart = new Chart(invoiceStatusChart, {
                    type: 'pie',
                    data: {
                        labels: ['مدفوع', 'غير مدفوع', 'بانتظار الدفع'],
                        datasets: [{
                            label: 'حالة الفواتير',
                            data: [200, 500, 600],
                            backgroundColor: ['#4caf50', '#f44336', '#ff9800'],
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        layout: {
                            padding: 20 // ⬅️ تحكم في المسافة حول الرسم
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 20
                                }
                            }
                        },
                        // هذه أهم نقطة للتحكم في الحجم الفعلي للدائرة
                        radius: '100%', // ⬅️ النسبة المئوية لحجم الدائرة
                        onClick: function(e, elements) {
                            if (elements.length > 0) {
                                const clickedIndex = elements[0].index;
                                let status = null;

                                if (clickedIndex === 0) status = 1; // مدفوع
                                else if (clickedIndex === 1) status = 0; // غير مدفوع
                                else if (clickedIndex === 2) status = 2; // بانتظار

                                loadInvoiceTable({
                                    status_id: status
                                });
                            }
                        }
                    }
                });

            });
        }
        let branchChart;

        function loadBranchChart() {
            $.get("{{ route('admin.invoices.chartBranches') }}", function(response) {
                const ctx = document.getElementById('branchChartCanvas').getContext('2d');

                if (branchChart) {
                    branchChart.destroy();
                }

                branchChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: response.labels,
                        datasets: [{
                            label: 'الفروع',
                            data: response.data,
                            backgroundColor: response.colors,
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        layout: {
                            padding: 20
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 20
                                }
                            }
                        },
                        radius: '100%',
                        onClick: function(e, elements) {
                            if (elements.length > 0) {
                                const clickedIndex = elements[0].index;
                                const branchId = response.ids[clickedIndex];


                                loadInvoiceTable({
                                    branch_id: branchId
                                });
                            }
                        }
                    }
                });
            });
        }





        loadInvoiceChart();
        loadBranchChart();

        // const branchLabels = @json($branchLabels);
        // const invoiceAmount = @json($invoiceAmount);

        // const total = invoiceAmount.reduce((a, b) => a + b, 0);

        // const backgroundColors = [
        //     '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
        //     '#858796', '#20c997', '#fd7e14', '#6f42c1', '#e83e8c'
        // ];

        // const ctx = document.getElementById('invoicesByBranchChart').getContext('2d');

        // const chart = new Chart(ctx, {
        //     type: 'doughnut',
        //     data: {
        //         labels: branchLabels,
        //         datasets: [{
        //             data: invoiceAmount,
        //             backgroundColor: backgroundColors,
        //             borderColor: '#fff',
        //             borderWidth: 2
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 position: 'bottom',
        //                 labels: {
        //                     color: '#333',
        //                     padding: 20
        //                 }
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         const label = context.label || '';
        //                         const value = context.parsed;
        //                         const percentage = ((value / total) * 100).toFixed(1);
        //                         return `${label}: ${value}  (${percentage}%)`;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // });





        const usersChartCtx = document.getElementById('usersChart').getContext('2d');

        const usersChart = new Chart(usersChartCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($userLabels) !!},
                datasets: [{
                    label: 'عدد المستخدمين',
                    data: {!! json_encode($usersPerBranch) !!},
                    backgroundColor: [
                        '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796',
                        '#20c997', '#6f42c1', '#fd7e14', '#0dcaf0'
                    ],
                    borderRadius: 8,
                    barThickness: 24,
                }]
            },
            options: {
                indexAxis: 'y', // لجعل الشريط أفقيًا
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} مستخدم`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return value + ' مستخدم';
                            }
                        },
                        grid: {
                            borderDash: [3, 3],
                            color: '#f1f1f1'
                        }
                    },
                    y: {
                        ticks: {
                            color: '#5e5e5e',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });


        // const specializationChart = document.getElementById('specializationChart').getContext('2d');

        // new Chart(specializationChart, {
        //     type: 'doughnut', // أو 'pie'
        //     data: {
        //         labels: {!! json_encode($specialization_labels) !!},
        //         datasets: [{
        //             data: {!! json_encode($specialization_data) !!},
        //             backgroundColor: {!! json_encode($specialization_colors) !!},
        //             borderWidth: 1,
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         plugins: {
        //             legend: {
        //                 display: true,
        //                 position: 'bottom',
        //                 labels: {
        //                     font: {
        //                         size: 10
        //                     },
        //                     boxWidth: 12,
        //                     padding: 10
        //                 }
        //             },
        //             tooltip: {
        //                 callbacks: {
        //                     label: function(context) {
        //                         let label = context.label || '';
        //                         let value = context.parsed;
        //                         let total = context.chart._metasets[0].total;
        //                         let percentage = ((value / total) * 100).toFixed(1);
        //                         return `${label}: ${value} مستخدم (${percentage}%)`;
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // });

        $(document).ready(function() {
            // إنشاء المخطط أول مرة
            const ctx = document.getElementById('invoicesByBranchChart').getContext('2d');
            let chart;

            function loadChart(status = 'not_paid') {
                $.ajax({
                    url: "{{ route('admin.invoices.chart') }}", // route يعيد بيانات JSON
                    type: "GET",
                    data: {
                        status: status
                    },
                    success: function(response) {
                        const branchLabels = response.branchLabels;
                        const invoiceAmount = response.invoiceAmount;
                        const total = invoiceAmount.reduce((a, b) => a + b, 0);

                        $('.total_invoice_amount').html(
                            '<i class="fas fa-dollar-sign"></i> ' + response.totalDollar +
                            ' &nbsp; - &nbsp; ' +
                            '<i class="fas fa-shekel-sign"></i> ' + response.totalShekel
                        );

                        if (status == 'not_paid') {
                            $('.invoice_title').text(
                                "{{ __('label.total_invoice_non_piad_monthly') }}");

                        } else {
                            $('.invoice_title').text("{{ __('label.total_invoice_piad_monthly') }}");

                        }

                        const backgroundColors = [
                            '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b',
                            '#858796', '#20c997', '#fd7e14', '#6f42c1', '#e83e8c'
                        ];

                        const chartData = {
                            labels: branchLabels,
                            datasets: [{
                                data: invoiceAmount,
                                backgroundColor: backgroundColors,
                                borderColor: '#fff',
                                borderWidth: 2
                            }]
                        };

                        const chartOptions = {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: '#333',
                                        padding: 20
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.parsed;
                                            const percentage = ((value / total) * 100).toFixed(
                                                1);
                                            return `${label}: ${value}  (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        };

                        if (chart) {
                            chart.data = chartData;
                            chart.options = chartOptions;
                            chart.update();
                        } else {
                            chart = new Chart(ctx, {
                                type: 'doughnut',
                                data: chartData,
                                options: chartOptions
                            });
                        }
                    },
                    error: function() {
                        console.error('حدث خطأ أثناء تحميل بيانات المخطط');
                    }
                });
            }

            // التحميل الافتراضي للفواتير الغير مدفوعة
            loadChart('not_paid');

            // عند الضغط على أي زر
            $('.invoice_not_paid').on('click', function(e) {
                e.preventDefault();
                loadChart('not_paid');
            });

            $('.invoice_paid').on('click', function(e) {
                e.preventDefault();
                loadChart('paid');
            });
        });
    </script>
@endpush
