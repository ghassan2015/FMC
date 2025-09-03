<?php

namespace App\Http\Controllers\Admin\SurgicalOperations;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\SurgicalOperation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SurgicalOperationController extends Controller
{

        public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        $data['constants']=Constant::query()->where('group_name','status')->get();
        $data['users']=User::query()->get();
        return view('admin.surgicalOperations.index', $data); // Load the view for DataTable
    }


 public function getIndex(Request $request)
{
    $search = $request->input('search.value');

    // استعلام أساسي مع العلاقة user
    $query = SurgicalOperation::with(['users','statuscd'])->orderBy('id', 'desc');

    // 🔎 البحث داخل العلاقة user (name, email, mobile) أو ID
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('id', $search)
                ->orWhereHas('users', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                       ->orWhere('email', 'like', "%{$search}%")
                       ->orWhere('mobile', 'like', "%{$search}%");
                });
        });
    }

    // 📌 فلترة بالتاريخ والحالة إذا موجودة
    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }
    if ($request->filled('status_id')) {
        $query->where('status', $request->status_id);
    }
    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }



    return DataTables::of($query)
        ->addColumn('user_name', fn($data) => $data->users?->name ?? '-')
        ->addColumn('doctor_name', fn($data) => $data->doctors?->name ?? '-')
        ->addColumn('branch_name', fn($data) => $data->branches?->value_name ?? '-')
        ->addColumn('status', fn($data) => $data->statuscd?->value_name ?? '-')
        ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d') ?? '-')


        ->addColumn('action', fn($data) => view('admin.surgicalOperations.partials.actions', compact('data')))
        ->rawColumns([ 'action'])
        ->with([
            'surgical_operation_competed' => (clone $query)->where('status', 10)->count(),
            'surgical_operation_count'    => (clone $query)->count(),
            'surgical_operation_pendding' => (clone $query)->where('status', 1)->count(),
        ])
        ->make(true);
}


    public function store(Request $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except(['surgical_operation_id','_token']);


        SurgicalOperation::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public  function  update(Request $request)
    {
        $data = $request->except(['surgical_operation_id','_token']);



        $surgical_Operations =  SurgicalOperation::query()->where('id', $request->surgical_operation_id)->first();




        $surgical_Operations->update($data);



        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }




    public  function  delete(Request $request)
    {

        SurgicalOperation::query()->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
