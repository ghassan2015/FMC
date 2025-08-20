<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Services\ServiceRequest;
use App\Models\Service;
use Flasher\Prime\Storage\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Yajra\DataTables\Facades\DataTables;

class ServicController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Service::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name');

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)
            ->addColumn('photo', fn($data) => view('admin.services.partials.cover', compact('data')))

            ->addColumn('is_active', fn($data) => view('admin.services.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.services.partials.actions', compact('data')))
            ->rawColumns(['action', 'status', 'branch_name'])
            ->make(true);
    }


    // Store a new branch
    public function store(ServiceRequest $request)
    {
        try {

            $path = $request->file('avatar')->store('services', 'public');

            Service::query()->create([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],

                'is_active' => $request->is_active ? 1 : 0,
                'photo' => $path
            ]);



            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Update an existing branch
    public function update(ServiceRequest $request)
    {
        try {
            $service = Service::query()->where('id', $request->service_id)->first();
            $service->update([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'is_active' => $request->is_active ? 1 : 0,

            ]);


            if ($request->avatar) {


                if ($service->photo && FacadesStorage::disk('public')->exists($service->photo)) {
                    FacadesStorage::disk('public')->delete($service->photo);
                }
                $path = $request->file('avatar')->store('services', 'public');
                $service->update([
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
            $service = Service::query()->where('id', $request->id)->first();
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
            $service = Service::query()->findOrFail($request->service_id);
            $service->update([
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
