<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function invoicesChart()
    {
        // Logic to fetch and prepare invoice data for chart
        $data = []; // Replace with actual data fetching logic

        return response()->json($data);
    }
}
