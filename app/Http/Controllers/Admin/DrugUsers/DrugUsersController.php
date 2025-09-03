<?php

namespace App\Http\Controllers\Admin\DrugUsers;

use App\Http\Controllers\Controller;
use App\Models\DrugUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DrugUsersController extends Controller
{
   public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        return view('admin.drugUsers.index', $data); // Load the view for DataTable
    }

    public function getIndex(Request $request)
    {

        $serach = $request->search ;
        // if ($request->ajax()) {
        $query = DrugUser::query()
            ->orderby('id', 'desc')

            ->when($serach, function ($q) use ($serach) {
                $q->where('name', 'like', '%' . $serach . '%');
            });

        if ($request->has('order')) {
            $columnIndex = $request->input('order.0.column'); // Get the index of the column to sort
            $direction = $request->input('order.0.dir'); // Get the sort direction (asc or desc)
            $columns = ['id', 'name',]; // List of sortable columns

            // Validate and apply the sort
            if (isset($columns[$columnIndex])) {
                $query->orderBy($columns[$columnIndex], $direction);
            }
        }


        return DataTables::of($query)


            ->addColumn('created_at', fn($data) => $data->created_at->format('Y-m-d'))

            ->addColumn('action', fn($data) => view('admin.drugUsers.partials.actions', compact('data')))
            ->rawColumns([  'actions'])
            ->make(true);
        // }

        return response()->json(['error' => 'Invalid request'], 400);
    }


    public function store(Request $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except([ 'drug_user_id', '_token']);






        DrugUser::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public  function  update(Request $request)
    {
        $data = $request->except([  'drug_user_id']);


      $drugUsers=  DrugUser::query()->where('id', $request->drug_id)->first();


        $drugUsers->update($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }




    public  function  delete(Request $request)
    {

        DrugUser::query()->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }
}
