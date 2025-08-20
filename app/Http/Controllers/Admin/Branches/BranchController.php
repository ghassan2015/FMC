<?php

namespace App\Http\Controllers\Admin\Branches;

use App\Exports\Admin\Branches\BranchesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Branches\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function index()
    {
        return view('admin.branches.index');
    }

    // Fetch branches data for DataTables
    public function getIndex(Request $request)
    {
        $search = $request->search ?? null;

        $data = Branch::query()
            ->when(isset($request->is_active), fn($q) => $q->where('is_active', $request->is_active))

            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name'); // Ordering by name

        return DataTables::of($data)
            ->addColumn('name', fn($data) => $data->name)
                        ->addColumn('address', fn($data) => $data->address)

            ->addColumn('is_active', fn($data) => view('admin.branches.partials.status', compact('data')))
            ->addColumn('action', fn($data) => view('admin.branches.partials.actions', compact('data')))
            ->rawColumns(['action', 'status', 'branch_name'])
            ->make(true);
    }


    // Store a new branch
    public function store(BranchRequest $request)
    {
        try {
            $path = $request->file('avatar')->store('services', 'public');

            $branch = Branch::query()->create([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'address' => ['ar' => $request->address_ar, 'en' => $request->address_en],

                'is_active' => $request->is_active ? 1 : 0,
                'photo' => $path
            ]);



            return response_web(true, __('label.successful_process'), [], 201);
        } catch (\Exception $exception) {
            return response_web(false, __('label.error_server'), [], 500);
        }
    }

    // Update an existing branch
    public function update(BranchRequest $request)
    {
        try {
            $branch = Branch::query()->findOrFail($request->branch_id);

            $branch->update([
              'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'address' => ['ar' => $request->address_ar, 'en' => $request->address_en],

                'is_active' => $request->is_active ? 1 : 0,

            ]);

               if ($request->avatar) {


                if ($branch->photo && Storage::disk('public')->exists($branch->photo)) {
                    Storage::disk('public')->delete($branch->photo);
                }
                $path = $request->file('avatar')->store('services', 'public');
                $branch->update([
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
            $branch = Branch::query()->where('id', $request->id)->first();
            $branchName = $branch->name;
            $branch->delete();

            // Log the deletion of a branch


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
            $branch = Branch::query()->findOrFail($request->branch_id);
            $branch->update([
                'is_active' => $request->is_active ,
            ]);



            return response()->json([
                "status" => 201,
                'message' => __('label.successful_process'),
            ]);
        } catch (\Exception $ex) {
            return $ex;

            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    public function pdfExport(Request $request)
    {
        $branches = Branch::query()
            ->when(isset($request->is_active), fn($q) => $q->where('status', $request->is_active));





        if ($request->filled('search')) {
            $search = $request->input('search');
            $branches->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }
        $data = [
            'branches' => $branches->get(),
        ];

        $html = view('admin.branches.export.pdf', $data)->render();

        // Footer HTML
        $footerHtml = view('admin.layouts.exports.footer')->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 25,
            'margin_bottom' => 30, // increase bottom margin for footer
            'margin_header' => 10,
            'margin_footer' => 10,
            'default_font' => 'dejavusans'
        ]);

        $mpdf->SetTitle('تقرير الفروع');

        // Set custom HTML footer
        $mpdf->SetHTMLFooter($footerHtml);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('branches.pdf', 'I');
    }

    public function excelExport(Request $request)
    {
        $branches = Branch::query()
            ->when(isset($request->is_active), fn($q) => $q->where('status', $request->is_active));

        if ($request->filled('search')) {
            $search = $request->input('search');
            $branches->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }
        return Excel::download(new BranchesExport($branches->get()), 'branches.xlsx');
    }
}
