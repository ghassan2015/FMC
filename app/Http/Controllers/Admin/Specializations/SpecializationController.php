<?php

namespace App\Http\Controllers\Admin\Specializations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specializations\SpecializationRequest;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SpecializationController extends Controller
{
        public function index()
    {
        return view('admin.specializations.index');
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Specialization::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name');

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)
            ->addColumn('photo', fn($data) => view('admin.specializations.partials.cover', compact('data')))

            ->addColumn('is_active', fn($data) => view('admin.specializations.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.specializations.partials.actions', compact('data')))
            ->rawColumns(['action', 'status', 'branch_name'])
            ->make(true);
    }


    // Store a new branch
    public function store(SpecializationRequest $request)
    {
        try {

            $path = $request->file('avatar')->store('services', 'public');

            Specialization::query()->create([
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
    public function update(SpecializationRequest $request)
    {
        try {
            $specialization = Specialization::query()->where('id', $request->specialization_id)->first();
            $specialization->update([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'is_active' => $request->is_active ? 1 : 0,

            ]);


            if ($request->avatar) {


                if ($specialization->photo && Storage::disk('public')->exists($specialization->photo)) {
                    Storage::disk('public')->delete($specialization->photo);
                }
                $path = $request->file('avatar')->store('services', 'public');
                $specialization->update([
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
            $service = Specialization::query()->where('id', $request->id)->first();
            $service->delete();
            
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
            $service = Specialization::query()->findOrFail($request->specialization_id);
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
