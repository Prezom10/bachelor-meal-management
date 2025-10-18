<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meal;
use App\Models\Market;
use App\Models\Statement;
use App\Models\Notice;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalMeals = $user->meals()->where('is_approved', true)->sum('lunch') + $user->meals()->where('is_approved', true)->sum('dinner');
        $totalMarket = $user->markets()->where('is_approved', true)->sum('amount');

        // Example data for charts
        $mealData = [
            'labels' => ['Lunch', 'Dinner'],
            'data' => [$user->meals()->where('is_approved', true)->sum('lunch'), $user->meals()->where('is_approved', true)->sum('dinner')],
        ];

        $marketData = [
            'labels' => ['Approved', 'Pending'],
            'data' => [$user->markets()->where('is_approved', true)->sum('amount'), $user->markets()->where('is_approved', false)->sum('amount')],
        ];

        return view('user.dashboard', compact('totalMeals', 'totalMarket', 'mealData', 'marketData'));
    }

    public function statement()
    {
        $user = Auth::user();
        $statements = $user->statements()->orderBy('month', 'desc')->get();
        return view('user.statement', compact('statements'));
    }

    public function notices()
    {
        $user = Auth::user();
        $notices = $user->notices()->orderBy('created_at', 'desc')->get();
        return view('user.notices', compact('notices'));
    }
}