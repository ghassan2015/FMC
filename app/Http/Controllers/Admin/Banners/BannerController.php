<?php

namespace App\Http\Controllers\Admin\Banners;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banners\BannerRequest;
use App\Models\Banner;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banners.index');
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Banner::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('id', 'desc');

        return DataTables::of($data)
            ->addColumn('title', fn($data) => $data->title)
            ->addColumn('photo', fn($data) => view('admin.banners.partials.cover', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.banners.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.banners.partials.actions', compact('data')))
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    // Store a new branch
    public function store(BannerRequest $request)
    {
        try {

            $path = $request->file('avatar')->store('banners', 'public');

            Banner::query()->create([
                'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
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
    public function update(BannerRequest $request)
    {
        try {
            $banner = Banner::query()->where('id', $request->banner_id)->first();
            $banner->update([
                'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'is_active' => $request->is_active ? 1 : 0,

            ]);


            if ($request->avatar) {


                if ($banner->photo && Storage::disk('public')->exists($banner->photo)) {
                    Storage::disk('public')->delete($banner->photo);
                }
                $path = $request->file('avatar')->store('banners', 'public');
                $banner->update([
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
            $service = Banner::query()->where('id', $request->id)->first();
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
            $banner = Banner::query()->findOrFail($request->banner_id);
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
