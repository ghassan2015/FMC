<?php

namespace App\Http\Controllers\Admin\MedicalTest;

use App\Http\Controllers\Controller;
use App\Models\MedicalTest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicalTestController extends Controller
{
    public function index(Request $request)
    {
        $data['modal'] = $request->modal;
        return view('admin.medicalTests.index', $data); // Load the view for DataTable
    }

    public function getIndex(Request $request)
    {

        $serach = $request->search['value'] ?? false;
        // if ($request->ajax()) {
        $query = MedicalTest::query()
            ->orderby('id', 'desc')

            ->when($serach, function ($q) use ($serach) {
                $q->where('name', 'like', '%' . $serach . '%');
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
            ->addColumn('is_active', fn($data) => view('admin.medicalTests.partials.active_toggle', compact('data')))

            ->addColumn('action', fn($data) => view('admin.medicalTests.partials.actions', compact('data')))
            ->rawColumns(['is_active',  'actions'])
            ->make(true);
        // }

        return response()->json(['error' => 'Invalid request'], 400);
    }


    public function store(Request $request)
    {
        // Exclude the non-standard name fields from the request data
        $data = $request->except(['name_ar', 'name_en',  'medical_test_id', '_token']);

        $data['name'] = [
            'ar' => $request->name_ar,
            'en' => $request->name_en, // Fixed typo from 'en' to 'name_en'
        ];
        $data['description'] = [
            'ar' => $request->description_ar,
            'en' => $request->description_en, // Fixed typo from 'en' to 'name_en'
        ];





        MedicalTest::create($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public  function  update(Request $request)
    {
        $data = $request->except(['name_ar', 'name_en',  'medical_test_id', 'is_active']);

        $data['name'] = [
            'ar' => $request->name_ar,
            'en' => $request->name_en, // Fixed typo from 'en' to 'name_en'
        ];
        $data['description'] = [
            'ar' => $request->description_ar,
            'en' => $request->description_en, // Fixed typo from 'en' to 'name_en'
        ];

        $city = MedicalTest::query()->where('id', $request->medical_test_id)->first();


        $data['is_active'] = $request->is_active ? 1 : 0;
        $city->update($data);

        // Return a successful response with the created company data
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }




    public  function  delete(Request $request)
    {

        MedicalTest::query()->where('id', $request->id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('label.process_success'),
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {


            $request->validate([
                'medical_test_id' => 'required|exists:medical_tests,id',
                'is_active' => 'required|boolean',
            ]);

            // Update the company's active status
            $medicalTest = MedicalTest::find($request->medical_test_id);
            $medicalTest->is_active = $request->is_active;
            $medicalTest->save();

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
