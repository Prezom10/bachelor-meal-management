@extends('layouts.master')

@section('content')
    <div class="flex min-h-screen bg-gray-100">
        <!-- Admin Sidebar -->
        <aside class="w-64 bg-gray-800 text-white p-6 space-y-4 flex-shrink-0 shadow-lg">
            <h2 class="text-3xl font-extrabold mb-6 text-center">Admin Panel</h2>
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.users.index') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-users mr-3"></i>User Management
                </a>
                <a href="{{ route('admin.meal_approvals.index') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.meal_approvals.index') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-utensils mr-3"></i>Meal Approvals
                </a>
                <a href="{{ route('admin.market_approvals.index') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.market_approvals.index') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-shopping-cart mr-3"></i>Market Approvals
                </a>
                <a href="{{ route('admin.notices.index') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.notices.index') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-bullhorn mr-3"></i>Notice Management
                </a>
                <a href="{{ route('admin.monthly_report.index') }}" class="flex items-center py-3 px-4 rounded-lg text-lg font-medium hover:bg-gray-700 transition duration-300 {{ request()->routeIs('admin.monthly_report.index') ? 'bg-gray-700 text-blue-300' : 'text-gray-300' }}">
                    <i class="fas fa-file-alt mr-3"></i>Monthly Report
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8 bg-gray-50">
            @yield('admin-content')
        </main>
    </div>
@endsection
