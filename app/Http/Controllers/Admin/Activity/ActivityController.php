<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{
    public function index()
    {
        $data['admins']=Admin::all();
        return view('admin.activities.index',$data);
    }

    public function getIndex(Request $request)
    {
        $query = Activity::query()
          ->when($request->filled('search'), function ($query) use ($request) {
$query->where('description', 'like', "%{$request->search}%");
          })
        ->when($request->filled('admin_id'), function ($query) use ($request) {
            $query->where('causer_id', $request->admin_id);
        })->when($request->filled('start_date') && $request->filled('end_date'), function ($query) use ($request) {
            $query->where('created_at', '>=', $request->start_date)->where('created_at', '<=', $request->end_date);
        })

        ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addColumn('log_name', function($data) {
    return $data->properties['route_name'] ?? '-';
            })
            ->addColumn('description', function($data) {
                return $data->description;
            })
            ->addColumn('causer', function($data) {
                return $data->causer ? $data->causer->name : 'N/A';
            })
            ->addColumn('created_at', function($data) {
                return $data->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['description'])
            ->make(true);
    }
}
