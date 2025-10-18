<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarketRequest;
use App\Models\Market;
use Illuminate\Support\Facades\Auth;

class MarketEntryController extends Controller
{
    public function create()
    {
        return view('user.market_entry');
    }

    public function store(StoreMarketRequest $request)
    {
        Market::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'amount' => $request->amount,
            'description' => $request->description,
            'is_approved' => false,
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Market entry submitted for approval.');
    }
}