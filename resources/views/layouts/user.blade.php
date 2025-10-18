@extends('layouts.master')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- User Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6 space-y-4 flex-shrink-0 shadow-lg">
            <h2 class="text-3xl font-extrabold mb-6 text-center">User Panel</h2>
            <nav class="space-y-2">
                <a href="{{ route('user.dashboard') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.dashboard') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('user.meal_entry.create') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.meal_entry.create') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-utensils mr-3"></i>Meal Entry
                </a>
                <a href="{{ route('user.market_entry.create') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.market_entry.create') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-shopping-cart mr-3"></i>Market Entry
                </a>
                <a href="{{ route('user.profile.edit') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.profile.edit') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-user-circle mr-3"></i>Profile
                </a>
                <a href="{{ route('user.statement') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.statement') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-file-invoice-dollar mr-3"></i>Monthly Statement
                </a>
                <a href="{{ route('user.notices') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('user.notices') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-bell mr-3"></i>Notices
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('user-content')
        </main>
    </div>
@endsection
