@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-2 border-blue-500 pb-2">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Users</h3>
            <p class="text-5xl font-bold text-indigo-700">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Pending Users</h3>
            <p class="text-5xl font-bold text-yellow-700">{{ $pendingUsers }}</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Meals (Approved)</h3>
            <p class="text-5xl font-bold text-green-700">{{ $totalMeals }}</p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Market (Approved)</h3>
            <p class="text-5xl font-bold text-blue-700">BDT {{ number_format($totalMarket, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Meal Distribution</h3>
            <div class="h-80">
                <canvas id="adminMealChart"></canvas>
            </div>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Market Expense Overview</h3>
            <div class="h-80">
                <canvas id="adminMarketChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Meal Chart
        const adminMealCtx = document.getElementById('adminMealChart').getContext('2d');
        new Chart(adminMealCtx, {
            type: 'bar',
            data: {
                labels: @json($mealData['labels']),
                datasets: [{
                    label: 'Meals',
                    data: @json($mealData['data']),
                    backgroundColor: ['rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Market Chart
        const adminMarketCtx = document.getElementById('adminMarketChart').getContext('2d');
        new Chart(adminMarketCtx, {
            type: 'pie',
            data: {
                labels: @json($marketData['labels']),
                datasets: [{
                    label: 'Market Expenses',
                    data: @json($marketData['data']),
                    backgroundColor: ['rgba(255, 206, 86, 0.8)', 'rgba(255, 99, 132, 0.8)'],
                    borderColor: ['rgba(255, 206, 86, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    </script>
@endsection
