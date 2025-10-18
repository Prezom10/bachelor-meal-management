<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statement;
use App\Models\User;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
        $statements = Statement::with('user')->where('month', $month)->get();
        $users = User::where('role', 'user')->get();

        return view('admin.monthly_report', compact('statements', 'month', 'users'));
    }
}