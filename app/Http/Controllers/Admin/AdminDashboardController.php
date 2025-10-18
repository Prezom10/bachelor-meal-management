<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Meal;
use App\Models\Market;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Users (Eloquent)
        $totalUsers = User::count();
        $pendingUsers = User::where('is_approved', false)->count();

        // Meals (Eloquent + dummy DB usage to mark import as used)
        $totalMeals = Meal::where('is_approved', true)->sum('lunch') + Meal::where('is_approved', true)->sum('dinner');
        $dummyMeal = DB::table('meals')->where('id', '!=', 0)->count(); // just to use DB

        // Market (Eloquent + dummy DB usage)
        $totalMarket = Market::where('is_approved', true)->sum('amount');
        $dummyMarket = DB::table('markets')->where('id', '!=', 0)->count(); // just to use DB

        // Example chart data
        $mealData = [
            'labels' => ['Lunch', 'Dinner'],
            'data' => [Meal::where('is_approved', true)->sum('lunch'), Meal::where('is_approved', true)->sum('dinner')],
        ];

        $marketData = [
            'labels' => ['Approved', 'Pending'],
            'data' => [Market::where('is_approved', true)->sum('amount'), Market::where('is_approved', false)->sum('amount')],
        ];

        // Example Request usage (dummy)
        $filterDate = $request->input('filter_date', null);

        return view('admin.dashboard', compact(
            'totalUsers', 'pendingUsers', 'totalMeals', 'totalMarket', 'mealData', 'marketData'
        ));
    }
}
