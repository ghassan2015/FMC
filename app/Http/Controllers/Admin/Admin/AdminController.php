<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Exports\Admin\Admins\AdminExport;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\AdminRequest;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;

class AdminController extends Controller
{
    public function index()
    {
        $data['branches'] = Branch::query()->active()->get();
        $data['roles'] = Role::query()->active()->get();
        return view('admin.admins.index', $data);
    }

    public function getIndex(Request $request)
    {
        $admins = Admin::query();

        if ($request->filled('branch_id')) {
            $admins->where('branch_id', $request->branch_id);
        }

        if ($request->filled('role_id')) {
            $admins->where('role_id', $request->role_id);
        }

        if ($request->filled('is_active')) {
            $admins->where('status', $request->is_active);
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $admins->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }

        $validColumns = ['name', 'email', 'mobile', 'is_active', 'created_at'];

        if ($request->filled('order.0.column')) {
            $columnIndex = $request->input('order.0.column');
            $columnDir = $request->input('order.0.dir', 'asc');
            $columnName = $request->input("columns.$columnIndex.data");

            if (in_array($columnName, $validColumns)) {
                $admins->orderBy($columnName, $columnDir);
            }
        }

        return DataTables::of($admins)
            ->addColumn('role', fn($admin) => optional($admin->role)->name)
            ->addColumn('branches', fn($admin) => optional($admin->branches)->name)
            ->addColumn('image', fn($admin) => $admin->getAttachment())
            ->addColumn('status', fn($data) => view('admin.admins.partials.status', compact('data'))->render())
            ->addColumn('action', fn($data) => view('admin.admins.partials.actions', compact('data'))->render())
            ->rawColumns(['action', 'status', 'image'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.admins.create', [
            'roles' => Role::all(),
            'branches' => Branch::active()->get()
        ]);
    }

    public function store(AdminRequest $request)
    {
        try {





            $path = null;
            if ($request->avatar) {
                $path = $request->file('avatar')->store('admin', 'public');
            }

            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role_id' => $request->role_id,
                'is_active' => $request->status ?? 0,
                'password' => Hash::make($request->password),
                'branch_id' => $request->branch_id,
                'photo' => $path,
                'redirect_route' => $request->redirect_route,
            ]);




            return response()->json(['status' => 201, 'message' => __('label.successful_process')]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    public function edit($id)
    {
        return view('admin.admins.edit', [
            'admin' => Admin::findOrFail($id),
            'roles' => Role::all(),
            'branches' => Branch::all()
        ]);
    }

    public function update(AdminRequest $request)
    {
        try {
            $admin = Admin::findOrFail($request->admin_id);


            if ($request->avatar) {
                $path = $request->file('avatar')->store('profile', 'public');


                $admin->update([
                    'photo' => $path,
                ]);
            }

            $admin->update($request->except('password', 'avatar', 'admin_id','avatar_remove') + [
                'password' => $request->password ? Hash::make($request->password) : $admin->password,
            ]);


            return response()->json(['status' => 201, 'message' => __('label.successful_process')]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);

        $admin->update(['is_active' => intval($request->is_active)]);


        return response()->json(['status' => 201, 'message' => 'تم تغيير الحالة بنجاح']);
    }

    public function delete(Request $request)
    {
        try {
            $admin = Admin::findOrFail($request->id);
            $admin->delete();

            return response()->json(['status' => 201, 'message' => __('label.successful_process')]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 422,
                'message' => __('label.process_fail'),
            ]);
        }
    }
    public function exportPdf(Request $request)
    {
        $admin = Admin::query();


        if ($request->filled('role_id')) {
            $admin->where('role_id', $request->role_id);
        }
        if ($request->filled('status')) {
            $admin->where('status', $request->status);
        }


        if ($request->filled('search')) {
            $search = $request->input('search');
            $admin->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }
        $data = [
            'admin' => $admin->get(),
        ];

        $html = view('admin.admins.export.pdf', $data)->render();

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

        $mpdf->SetTitle('تقرير مستخدمين النظام');

        // Set custom HTML footer
        $mpdf->SetHTMLFooter($footerHtml);

        $mpdf->WriteHTML($html);

        return $mpdf->Output('employee_report.pdf', 'I');
    }

    public function exportExcel(Request $request)
    {
        $admins = Admin::query();
        if ($request->filled('branch_id')) {
            $admins->where('branch_id', $request->branch_id);
        }
        if ($request->filled('role_id')) {
            $admins->where('role_id', $request->role_id);
        }
        if ($request->filled('status')) {
            $admins->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->input('search');
            $admins->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('mobile', 'like', "%{$search}%");
            });
        }
        return Excel::download(new AdminExport($admins->get()), 'admins.xlsx');
    }
}
