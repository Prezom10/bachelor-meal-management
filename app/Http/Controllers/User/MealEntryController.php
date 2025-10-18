<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMealRequest;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class MealEntryController extends Controller
{
    public function create()
    {
        return view('user.meal_entry');
    }

    public function store(StoreMealRequest $request)
    {
        Meal::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'lunch' => $request->lunch,
            'dinner' => $request->dinner,
            'is_approved' => false,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Meal entry submitted for approval.');
    }
}