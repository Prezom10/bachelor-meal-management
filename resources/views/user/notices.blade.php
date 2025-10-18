@extends('layouts.user')

@section('user-content')
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-2 border-blue-500 pb-2">Your Notices</h2>

    @if ($notices->isEmpty())
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 text-center text-gray-600">
            <p>No notices available at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6">
            @foreach ($notices as $notice)
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $notice->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ $notice->description }}</p>
                    <p class="text-sm text-gray-500">Published: {{ $notice->created_at->format('M d, Y H:i A') }}</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection
