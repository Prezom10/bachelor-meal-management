@extends('layouts.user')

@section('user-content')
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Submit Daily Meal Entry</h2>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('user.meal_entry.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('date', date('Y-m-d')) }}" required>
                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lunch" class="block text-sm font-medium text-gray-700">Lunch Meals</label>
                <input type="number" name="lunch" id="lunch" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('lunch', 0) }}" min="0" required>
                @error('lunch')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="dinner" class="block text-sm font-medium text-gray-700">Dinner Meals</label>
                <input type="number" name="dinner" id="dinner" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ old('dinner', 0) }}" min="0" required>
                @error('dinner')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Meal Entry
                </button>
            </div>
        </form>
    </div>
@endsection