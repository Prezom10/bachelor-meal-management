@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Monthly Report</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Filter by Month</h3>
        <form action="{{ route('admin.monthly_report.index') }}" method="GET" class="flex items-center space-x-4">
            <input type="month" name="month" value="{{ $month }}" class="mt-1 block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Filter</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Statements for {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h3>
        @if ($statements->isEmpty())
            <p class="text-gray-600">No statements available for this month.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Meals</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Market (BDT)</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Balance (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statements as $statement)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $statement->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $statement->total_meals }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ number_format($statement->total_market, 2) }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm {{ $statement->balance >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($statement->balance, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection