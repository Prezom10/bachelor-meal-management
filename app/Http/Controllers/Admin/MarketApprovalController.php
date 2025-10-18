<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Market;
use Illuminate\Http\Request;
use App\Notifications\MarketApprovedAlert;
use Illuminate\Support\Facades\Notification;

class MarketApprovalController extends Controller
{
    public function index(Request $request)
    {
        $filterDate = $request->input('date', null);
        $pendingMarkets = Market::where('is_approved', false)->get();
        $approvedMarkets = Market::where('is_approved', true)->get();
        return view('admin.market_approval', compact('pendingMarkets', 'approvedMarkets'));
    }

    public function approve(Market $market)
    {
        $market->is_approved = true;
        $market->save();

        Notification::send($market->user, new MarketApprovedAlert($market));

        return redirect()->route('admin.market_approvals.index')->with('success', 'Market entry approved successfully.');
    }

    public function reject(Market $market)
    {
        $market->is_approved = false;
        $market->save();

        // Optionally send a rejection notification

        return redirect()->route('admin.market_approvals.index')->with('success', 'Market entry rejected.');
    }
}