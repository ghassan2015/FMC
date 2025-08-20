<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CitiesController extends Controller
{
   public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        return view('admin.cities.index', $data); // Load the view for DataTable
    }

    public function getIndex(Request $request)
    {

        $serach=$request->search['value']??false;
        // if ($request->ajax()) {
        $query = City::query()
        ->orderby('id', 'desc')

        ->when($serach, function ($q) use ($serach) {
            $q->where('name','like','%'. $serach.'%');
        });

        if ($request->has('order')) {
            $columnIndex = $request->input('order.0.column'); // Get the index of the column to sort
            $direction = $request->input('order.0.dir'); // Get the sort direction (asc or desc)
            $columns = ['id', 'name', 'is_active']; // List of sortable columns

            // Validate and apply the sort
            if (isset($columns[$columnIndex])) {
                $query->orderBy($columns[$columnIndex], $direction);
            }
        }


        return DataTables::of($query)

            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('is_active', fn($data) => view('admin.cities.partials.active_toggle', compact('data')))

            ->addColumn('action', fn($data) => view('admin.cities.partials.actions', compact('data')))
            ->rawColumns([ 'is_active',  'actions'])
            ->make(true);
        // }

        return response()->json(['error' => 'Invalid request'], 400);
    }


    public function store(Request $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except(['name_ar', 'name_en',  'city_id','_token']);

        $data['name'] = [
            'ar' => $request->name_ar,
            'en' => $request->name_en, // Fixed typo from 'en' to 'name_en'
        ];






        City::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public  function  update(Request $request)
    {
        $data = $request->except(['name_ar', 'name_en',  'city_id','is_active']);

        $data['name'] = [
            'ar' => $request->name_ar,
            'en' => $request->name_en, // Fixed typo from 'en' to 'name_en'
        ];

        $city = City::query()->where('id', $request->city_id)->first();


        $data['is_active']=$request->is_active?1:0;
        $city->update($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }




    public  function  delete(Request $request)
    {

        City::query()->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {


            $request->validate([
                'city_id' => 'required|exists:cities,id',
                'is_active' => 'required|boolean',
            ]);

            // Update the company's active status
            $city = City::find($request->city_id);
            $city->is_active = $request->is_active;
            $city->save();

            return response()->json([
                'success' => true,
                'message' => __('label.process_success'),
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => __('label.process_fail'),
            ]);
        }
    }


}
