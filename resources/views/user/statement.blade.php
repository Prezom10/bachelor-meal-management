@extends('layouts.user')

@section('user-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Your Monthly Statements</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        @if ($statements->isEmpty())
            <p class="text-gray-600">No monthly statements available yet.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Month</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Meals</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total Market (BDT)</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Balance (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($statements as $statement)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ \Carbon\Carbon::parse($statement->month)->format('F Y') }}</td>
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