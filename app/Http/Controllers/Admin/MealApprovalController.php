<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;
use App\Notifications\MealApprovedAlert;
use Illuminate\Support\Facades\Notification;

class MealApprovalController extends Controller
{
    public function index(Request $request)
    {
        $filterDate = $request->input('date', null);
        $pendingMeals = Meal::where('is_approved', false)->get();
        $approvedMeals = Meal::where('is_approved', true)->get();
        return view('admin.meal_approval', compact('pendingMeals', 'approvedMeals'));
    }

    public function approve(Meal $meal)
    {
        $meal->is_approved = true;
        $meal->save();

        Notification::send($meal->user, new MealApprovedAlert($meal));

        return redirect()->route('admin.meal_approvals.index')->with('success', 'Meal entry approved successfully.');
    }

    public function reject(Meal $meal)
    {
        $meal->is_approved = false;
        $meal->save();

        // Optionally send a rejection notification

        return redirect()->route('admin.meal_approvals.index')->with('success', 'Meal entry rejected.');
    }
}