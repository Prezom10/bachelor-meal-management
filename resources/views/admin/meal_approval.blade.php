@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Meal Approval</h2>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Pending Meal Entries</h3>
        @if ($pendingMeals->isEmpty())
            <p class="text-gray-600">No pending meal entries.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lunch</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dinner</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendingMeals as $meal)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->date }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->lunch }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->dinner }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">
                                    <form action="{{ route('admin.meal_approvals.approve', $meal) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.meal_approvals.reject', $meal) }}" method="POST" class="inline-block">
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
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Approved Meal Entries</h3>
        @if ($approvedMeals->isEmpty())
            <p class="text-gray-600">No approved meal entries.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lunch</th>
                            <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Dinner</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvedMeals as $meal)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->user->name }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->date }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->lunch }}</td>
                                <td class="py-2 px-4 border-b border-gray-200 text-sm">{{ $meal->dinner }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection