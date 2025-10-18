@extends('layouts.master')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-800">Verify Your Email Address</h2>

            <p class="text-gray-600 text-center">
                Before proceeding, please check your email for a verification link.
                If you did not receive the email,
            </p>

            <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    click here to request another
                </button>
            </form>

            @if (session('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
        </div>
    </div>
@endsection