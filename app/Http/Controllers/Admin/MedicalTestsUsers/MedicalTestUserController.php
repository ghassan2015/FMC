<?php

namespace App\Http\Controllers\Admin\MedicalTestsUsers;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\MedicalTest;
use App\Models\MedicalTestUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MedicalTestUserController extends Controller
{
    public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        $data['constants']=Constant::query()->where('group_name','status')->get();
        $data['medicalTests'] = MedicalTest::query()->get();
        $data['users']=User::query()->get();
        return view('admin.medicalTestUsers.index', $data); // Load the view for DataTable
    }


 public function getIndex(Request $request)
{
    $search = $request->input('search', null);

    // استعلام أساسي مع العلاقة user
    $query = MedicalTestUser::with(['users','statuscd'])->orderBy('id', 'desc');

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

    // ترتيب الأعمدة الديناميكي إذا جاء الطلب
    if ($request->has('order')) {
        $columnIndex = $request->input('order.0.column');
        $direction = $request->input('order.0.dir', 'desc');
        $columns = ['id', 'user_name', 'medical_test', 'status', 'created_at'];
        if (isset($columns[$columnIndex])) {
            if ($columns[$columnIndex] === 'user_name') {
                $query->join('users', 'medical_test_users.user_id', '=', 'users.id')
                      ->orderBy('users.name', $direction)
                      ->select('medical_test_users.*');
            } else {
                $query->orderBy($columns[$columnIndex], $direction);
            }
        }
    }

    return DataTables::of($query)
        ->addColumn('user_name', fn($data) => $data->users?->name ?? '-')
        ->addColumn('medical_test', fn($data) => $data->medicalTest?->name ?? '-')
        ->addColumn('photo', fn($data) => view('admin.medicalTestUsers.partials.cover', compact('data')))
        ->addColumn('status', fn($data) => $data->statuscd?->value_name ?? '-')

        ->addColumn('action', fn($data) => view('admin.medicalTestUsers.partials.actions', compact('data')))
        ->rawColumns(['photo', 'action'])
        ->with([
            'medical_test_competed' => (clone $query)->where('status', 1)->count(),
            'medical_test_count'    => (clone $query)->count(),
            'medical_test_pendding' => (clone $query)->where('status', 0)->count(),
        ])
        ->make(true);
}


    public function store(Request $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except(['medical_test_user_id', 'photo', '_token']);




        if ($request->hasFile('photo')) {

            $data['photo'] =  $request->file('photo')->store('medicalTest', 'public');
        }


        MedicalTestUser::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public  function  update(Request $request)
    {
        $data = $request->except(['medical_test_user_id', 'photo']);



        $meidcal_test_user =  MedicalTestUser::query()->where('id', $request->medical_id)->first();




        $meidcal_test_user->update($data);

        if ($request->hasFile('photo')) {
            // حذف الصورة القديمة إذا موجودة
            if ($meidcal_test_user->photo && Storage::disk('public')->exists($meidcal_test_user->photo)) {
                Storage::disk('public')->delete($meidcal_test_user->photo);
            }

            // رفع الصورة الجديدة
            $photo = $request->file('photo')->store('medicalTest', 'public');
            $meidcal_test_user->update(['photo' => $photo]);
        }

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }




    public  function  delete(Request $request)
    {

        MedicalTestUser::query()->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
