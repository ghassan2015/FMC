<?php

namespace App\Http\Controllers\Admin\Videoes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Videoes\VideoRequest;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VideoController extends Controller
{




    // عرض الصفحة الرئيسية
    public function index()
    {
        return view('admin.videos.index');
    }

    // جلب بيانات الفيديوهات لـ DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Video::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
            ->orderBy('id','desc');

        return DataTables::of($data)
            ->addColumn('title', fn($data) => $data->title)
            ->addColumn('thumbnail', fn($data) => view('admin.videos.partials.cover', compact('data')))
            ->addColumn('is_active', fn($data) => view('admin.videos.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.videos.partials.actions', compact('data')))
            ->rawColumns(['action', 'is_active', 'thumbnail'])
            ->make(true);
    }

    // حفظ فيديو جديد
    public function store(VideoRequest $request)
    {
        try {
            $path = $request->file('thumbnail')?->store('videos', 'public');

            Video::create([
                'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'url' => $request->url,
                'is_active' => $request->is_active ? 1 : 0,
                'thumbnail' => $path,
            ]);

            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => 500,
                'message' => __('label.error_server'),
            ]);
        }
    }

    // تحديث فيديو موجود
    public function update(VideoRequest $request)
    {
        try {
            $video = Video::findOrFail($request->video_id);

            $video->update([
                'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'url' => $request->url,

                'is_active' => $request->is_active ? 1 : 0,
            ]);

            if ($request->thumbnail) {
                if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
                    Storage::disk('public')->delete($video->thumbnail);
                }
                $path = $request->file('thumbnail')->store('videos', 'public');
                $video->update(['thumbnail' => $path]);
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

    // حذف فيديو
    public function delete(Request $request)
    {
        try {
            $video = Video::findOrFail($request->id);
            if ($video->thumbnail && Storage::disk('public')->exists($video->thumbnail)) {
                Storage::disk('public')->delete($video->thumbnail);
            }
            $video->delete();

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
