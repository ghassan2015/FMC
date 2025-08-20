<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Roles\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function getIndex(Request $request)
    {
        $data = Role::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('is_active'), function ($query) use ($request) {
                $query->where('is_active', $request->input('is_active'));
            });
        if ($request->has('order') && $request->has('columns')) {
            $orderColumnIndex = $request->input('order.0.column');
            $orderDirection = $request->input('order.0.dir', 'asc');
            // Get the name of the column to order by
            $orderColumn = $request->input("columns.$orderColumnIndex.data");

            // Define a whitelist of valid columns that can be ordered by
            $validColumns = ['name', 'status', 'created_at'];

            // Check if the requested column is valid to avoid SQL injection
            if (in_array($orderColumn, $validColumns)) {
                // Apply the ordering to the query
                $data->orderBy($orderColumn, $orderDirection);
            } else {
                // Default ordering if the requested column is not valid
                $data->orderBy('created_at', 'desc');
            }
        } else {
            // Default ordering if no specific ordering is requested
            $data->orderBy('created_at', 'desc');
        }

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)


            ->addColumn('status', fn($data) => view('admin.roles.partials.status', compact('data'))->render())
            ->addColumn('action', fn($data) => view('admin.roles.partials.actions', compact('data'))->render())

            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleRequest $request)
    {
        try {

            Role::query()->create([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'permission' => $request->permissions,
            ]);


            return response()->json([
                "status" => 201,
                'message' => __('label.process_success'),
                'redirect_url' => route('admin.roles.index')
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.An error occurred. Please try again later'),
            ]);
        }
    }

    public function edit($id)
    {
        $data['role'] = Role::findOrFail($id);
        return view('admin.roles.edit', $data);
    }

    public function update(RoleRequest $request)
    {
        try {
            $role = Role::findOrFail($request->role_id);

            $role = $this->process($role, $request);



            return response()->json([
                "status" => 201,
                'message' => __('label.process_success'),
                'redirect_url' => route('admin.roles.index')
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.An error occurred. Please try again later'),
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->update([
                'is_active' => intval($request->is_active),
            ]);



            return response()->json([
                "status" => 201,
                'message' => __('label.process_success'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => 500,
                'message' => __('label.An error occurred. Please try again later'),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $role = Role::findOrFail($request->id)->delete();
            return response()->json([
                "status" => 201,
                'message' => __('label.process_success'),
                'redirect_url' => route('admin.roles.index')
            ]);
        } catch (\Exception $ex) {

            return response()->json([
                "status" => 422,
                'message' => __('label.An error occurred. Please try again later'),
            ]);
        }
    }
    protected function process(Role $role, Request $request)
    {
        $role->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $role->permission = $request->permissions;
        $role->save();
        return $role;
    }
}
