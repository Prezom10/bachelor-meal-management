@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Market Expense Approval</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Pending Market Entries</h3>
        @if ($pendingMarkets->isEmpty())
            <p class="text-gray-600">No pending market entries.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingMarkets as $market)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->date }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">BDT {{ number_format($market->amount, 2) }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->description }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                    <form action="{{ route('admin.market_approvals.approve', $market) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.market_approvals.reject', $market) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Approved Market Entries</h3>
        @if ($approvedMarkets->isEmpty())
            <p class="text-gray-600">No approved market entries.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedMarkets as $market)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->date }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">BDT {{ number_format($market->amount, 2) }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $market->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection