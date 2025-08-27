<div class="dropdown text-center">
    <a href="#" class="btn btn-icon btn-light btn-active-light-primary btn-sm"
       data-kt-menu-trigger="click"
       data-kt-menu-placement="bottom-end"
       data-kt-menu-flip="top-end">
        <i class="fa fa-ellipsis-v fs-5"></i>
    </a>

    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600
                menu-state-bg-light-primary fw-bold fs-7 w-150px py-4"
         data-kt-menu="true">

        <!-- إرسال SMS -->


        <!-- تعديل الفاتورة -->
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3 edit_invoice d-flex align-items-center gap-2"
               data-invoice_id="{{ $data->id }}"
               data-amount="{{ $data->amount }}"
               data-payment_type_id="{{ $data->payment_type_id }}"
               data-status="{{ $data->status }}"
               data-amount_type="{{ $data->amount_type }}"
               data-photo="{{$data->photo}}"
               data-expiration_date="{{ $data->expiration_date ? \Carbon\Carbon::parse($data->expiration_date)->format('Y-m-d') : '' }}"
               data-due_date="{{ $data->due_date ? \Carbon\Carbon::parse($data->due_date)->format('Y-m-d') : '' }}">
                <i class="fas fa-edit text-primary"></i>
                {{ __('label.edit') }}
            </a>
        </div>

        <!-- اشتراك الإنترنت -->
        @if (auth('admin')->user()->can('view_internet_subscription'))
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3 internet_subscription d-flex align-items-center gap-2"
               data-invoice_id="{{ $data->id }}"
               data-user_id="{{ $data->user_id }}"
               data-desk_mangment_id="{{ $data->id }}"
               title=" {{__('label.intenert_subscription')}}">
                <i class="fas fa-wifi text-muted"></i>
                {{__('label.intenert_subscription')}}
            </a>
        </div>
        @endif

        <!-- الإشعارات -->
        <div class="menu-item px-3">
            <a href="#" class="menu-link px-3 sned_notification d-flex align-items-center gap-2"
               data-user_id="{{ $data->user_id }}">
                <i class="fas fa-bell text-warning"></i>
                {{ __('label.notifications') }}
            </a>
        </div>
    <div class="menu-item px-3">
            <a href="#" class="menu-link px-3 sendSms d-flex align-items-center gap-2"
               data-user_id="{{ $data->user_id }}">
                <i class="fas fa-sms text-dark"></i>
                {{ __('label.send_sms') }}
            </a>
        </div>
        <!-- سند قبض -->
        @if ($data->status == 1)
        <div class="menu-item px-3">
            <a href="{{ route('admin.invoices.generateReceipt', ['invoice_id' => $data->id]) }}"
               target="_blank"
               class="menu-link px-3 d-flex align-items-center gap-2"
               title="سند قبض">
                <i class="fas fa-file-pdf text-success"></i>
                سند قبض
            </a>
        </div>
        @endif

        <!-- حذف -->
        @if (!$data->photo)
        <div class="menu-item px-3">
            <a href="#" data-id="{{ $data->id }}"
              data-name_delete="{{ $data->users?->name ?? 'Unknown' }}"
               class="menu-link px-3 delete_invoice d-flex align-items-center gap-2">
                <i class="fa fa-trash text-danger"></i>
                {{ __('label.delete') }}
            </a>
        </div>
        @endif

    </div>
</div>
