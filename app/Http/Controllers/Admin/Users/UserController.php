<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UserRequest;
use App\Models\Constant;
use App\Models\Doctor;
use App\Models\MedicalTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {

        return view('admin.users.index');
    }

    public function getIndex(Request $request)
    {
        $search = $request->search['value'] ?? null;

        $data = User::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('id_number', 'like', "%{$search}%")
                        ->orWhere('mobile', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('title', fn($data) => $data->title)
            ->addColumn('photo', fn($data) => view('admin.users.partials.cover', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.users.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.users.partials.actions', compact('data')))
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        try {


            $user =  User::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'birth_date' => $request->birth_date,
                'id_number' => $request->id_number,
            ]);



            if ($request->avatar) {


                $path = $request->file('avatar')->store('users', 'public');
                $user->update([
                    'photo' => $path
                ]);
            }


            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }


    public function view($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        $data['users'] = User::query()->get();
        $data['medicalTests'] = MedicalTest::query()->get();
        $data['constants'] = Constant::query()->where('group_name', 'status')->get();
        $data['paymentTypes'] = Constant::query()->where('group_name', 'payment_type')->get();
        $data['appointmentStatus'] = Constant::query()->where('group_name', 'appointment')->get();

        $data['doctors']=Doctor::query()->get();



        return view('admin.users.view', $data);
    }
    public function edit($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        return view('admin.users.edit', $data);
    }

    // Update an existing branch
    public function update(UserRequest $request)
    {
        try {
            $user = User::query()->where('id', $request->user_id)->first();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'birth_date' => $request->birth_date,
                'id_number' => $request->id_number,
                'is_active' => $request->is_active ? 1 : 0,

            ]);





            if ($request->avatar) {


                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }
                $path = $request->file('avatar')->store('users', 'public');
                $user->update([
                    'photo' => $path
                ]);
            }

            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    // Delete a branch
    public function delete(Request $request)
    {
        try {
            $service = User::query()->where('id', $request->id)->first();
            $service->delete();

            // Log the deletion of a branchted a branch');

            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    // Update the status of a branch
    public function updateStatus(Request $request)
    {
        try {
            $banner = User::query()->findOrFail($request->user_id);
            $banner->update([
                'is_active' => $request->is_active
            ]);



            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }
}
