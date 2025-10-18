{{-- layouts.user এক্সটেন্ড করা হয়েছে --}}
@extends('layouts.user')

{{-- user-content সেকশনে কন্টেন্ট যুক্ত করা হয়েছে --}}
@section('user-content')

    {{-- ড্যাশবোর্ডের মূল শিরোনাম --}}
    <h2 class="text-4xl font-extrabold text-gray-900 mb-8 border-b-2 border-blue-500 pb-2">
        Your Dashboard
    </h2>

    {{-- পরিসংখ্যান কার্ডগুলির জন্য গ্রিড লেআউট --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">

        {{-- মোট অনুমোদিত খাবার কার্ড --}}
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Meals (Approved)</h3>
            {{-- খাবারের সংখ্যা প্রদর্শন। যদি ডেটা না থাকে তবে 'N/A' দেখাবে। --}}
            <p class="text-5xl font-bold text-indigo-700">{{ $totalMeals ?? 'N/A' }}</p>
        </div>

        {{-- মোট মার্কেট খরচ কার্ড --}}
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Total Market (Approved)</h3>
            {{-- মার্কেট খরচ ফরম্যাট করে প্রদর্শন (BDT সহ)। যদি ডেটা না থাকে তবে 0.00 দেখাবে। --}}
            <p class="text-5xl font-bold text-green-700">
                BDT {{ number_format($totalMarket ?? 0, 2) }}
            </p>
        </div>

        {{-- বর্তমান ব্যালেন্স কার্ড --}}
        <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Current Balance</h3>
            {{--
                ব্যালেন্স গণনা: মোট মার্কেট খরচ থেকে মোট খাবারের খরচের (প্রতি খাবার নির্দিষ্ট মূল্য ধরে)
                বিয়োগ করা হয়েছে।
                এই নির্দিষ্ট মূল্যটি Controller থেকে পাঠানো যেতে পারে অথবা config ফাইল থেকে নেওয়া যেতে পারে।
                এখানে একটি উদাহরণ হিসেবে `$mealCostPerPerson` ভেরিয়েবল ব্যবহার করা হয়েছে।
            --}}
            @php
                // ডিফল্ট মান হিসেবে ৩০ ধরা হয়েছে। এটি config/app.php থেকে নেওয়া ভালো।
                // যেমন: $mealCostPerPerson = config('app.meal_cost_per_person', 30);
                $mealCostPerPerson = $mealCostPerPerson ?? 30; // Controller থেকে ভেরিয়েবলটি আসবে আশা করা হচ্ছে
                $totalMealsCount = $totalMeals ?? 0;
                $totalMarketAmount = $totalMarket ?? 0;

                $totalMealCost = $totalMealsCount * $mealCostPerPerson;
                $currentBalance = $totalMarketAmount - $totalMealCost;
            @endphp
            {{-- ফরম্যাট করে ব্যালেন্স প্রদর্শন। --}}
            <p class="text-5xl font-bold text-red-700">
                BDT {{ number_format($currentBalance, 2) }}
            </p>
        </div>
    </div>

    {{-- চার্টগুলির জন্য গ্রিড লেআউট --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- খাবারের ডিস্ট্রিবিউশন চার্ট --}}
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Meal Distribution</h3>
            {{-- চার্টের জন্য ক্যানভাস এলিমেন্ট। একটি নির্দিষ্ট উচ্চতা দেওয়া হয়েছে। --}}
            <div class="h-80 relative">
                <canvas id="userMealChart"></canvas>
            </div>
        </div>

        {{-- মার্কেট এন্ট্রি স্ট্যাটাস চার্ট --}}
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h3 class="text-xl font-semibold text-gray-700 mb-4">Market Entry Status</h3>
            {{-- চার্টের জন্য ক্যানভাস এলিমেন্ট। একটি নির্দিষ্ট উচ্চতা দেওয়া হয়েছে। --}}
            <div class="h-80 relative">
                <canvas id="userMarketChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js লাইব্রেরি CDN থেকে লোড করা হচ্ছে --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // চার্টের জন্য সাধারণ অপশনগুলো একটি অবজেক্টে রাখা হয়েছে যাতে কোড পুনরাবৃত্তি না হয়।
        const commonChartOptions = {
            responsive: true,       // চার্টটি রেসপন্সিভ হবে
            maintainAspectRatio: false, // ক্যানভাসের উচ্চতা এবং প্রস্থ সঠিকভাবে নিয়ন্ত্রণ করার জন্য
            plugins: {
                legend: {
                    position: 'bottom', // চার্টের লিজেন্ড (Labels) নিচে দেখানো হবে
                },
                tooltip: {
                    // এখানে টুলটিপের জন্য অতিরিক্ত অপশন যোগ করা যেতে পারে
                    // enabled: true,
                }
            },
            // ডেটা না থাকলে বার্তা দেখানোর জন্য কাস্টমাইজেশন যোগ করা যেতে পারে
            // afterDraw: function(chart) {
            //     if (chart.data.datasets.length === 0 || chart.data.datasets[0].data.every(d => d === 0)) {
            //         const ctx = chart.ctx;
            //         const width = chart.width;
            //         const height = chart.height;
            //         ctx.restore();
            //         const fontSize = 16;
            //         ctx.font = `${fontSize}px Arial`;
            //         ctx.fillStyle = "#888";
            //         ctx.textBaseline = "middle";
            //         ctx.textAlign = "center";
            //         ctx.fillText("No data available", width / 2, height / 2);
            //         ctx.save();
            //     }
            // }
        };

        // --- Meal Chart Initialization ---
        const userMealCtx = document.getElementById('userMealChart').getContext('2d');
        const userMealChart = new Chart(userMealCtx, {
            type: 'doughnut', // চার্টের ধরন: ডোনাট
            data: {
                labels: {{ Js::from($mealData['labels'] ?? []) }}, // ডেটা পয়েন্টের লেবেল, Js::from() দিয়ে নিরাপদে পাস করা হয়েছে
                datasets: [{
                    label: 'Meals', // ডেটাসেটের নাম
                    data: {{ Js::from($mealData['data'] ?? []) }}, // চার্টের জন্য ডেটা
                    backgroundColor: ['#4CAF50', '#2196F3'], // ডেটা পয়েন্টগুলোর ব্যাকগ্রাউন্ড কালার
                    hoverOffset: 4 // মাউস হোভার করলে ডেটা পয়েন্ট কতটুকু সরে আসবে
                }]
            },
            options: commonChartOptions // উপরে ডিফাইন করা সাধারণ অপশন ব্যবহার করা হয়েছে
        });

        // --- Market Chart Initialization ---
        const userMarketCtx = document.getElementById('userMarketChart').getContext('2d');
        const userMarketChart = new Chart(userMarketCtx, {
            type: 'pie', // চার্টের ধরন: পাই
            data: {
                labels: {{ Js::from($marketData['labels'] ?? []) }}, // ডেটা পয়েন্টের লেবেল
                datasets: [{
                    label: 'Market Expenses', // ডেটাসেটের নাম
                    data: {{ Js::from($marketData['data'] ?? []) }}, // চার্টের জন্য ডেটা
                    backgroundColor: ['#FFC107', '#9E9E9E'], // ডেটা পয়েন্টগুলোর ব্যাকগ্রাউন্ড কালার
                    hoverOffset: 4 // মাউস হোভার করলে ডেটা পয়েন্ট কতটুকু সরে আসবে
                }]
            },
            options: commonChartOptions // উপরে ডিফাইন করা সাধারণ অপশন ব্যবহার করা হয়েছে
        });

        // ডেটা খালি থাকলে চার্টে 'No data available' দেখানোর জন্য একটি ফাংশন যুক্ত করা যেতে পারে
        // যদি mealData বা marketData খালি থাকে তবে ক্যানভাসে বার্তা দেখানোর জন্য নিচের কোড ব্যবহার করা যেতে পারে:
        // (Note: Uncomment and adapt if needed. The 'afterDraw' function in commonChartOptions is a placeholder)

        // Example for Meal Chart:
        // if (!{{ Js::from($mealData['data']) }} || {{ Js::from($mealData['data']) }}.length === 0) {
        //     const mealCanvas = document.getElementById('userMealChart');
        //     const mealCtx = mealCanvas.getContext('2d');
        //     mealCtx.font = "16px Arial";
        //     mealCtx.fillStyle = "#888";
        //     mealCtx.textAlign = "center";
        //     mealCtx.fillText("No meal data available", mealCanvas.width / 2, mealCanvas.height / 2);
        // }

        // Example for Market Chart:
        // if (!{{ Js::from($marketData['data']) }} || {{ Js::from($marketData['data']) }}.length === 0) {
        //     const marketCanvas = document.getElementById('userMarketChart');
        //     const marketCtx = marketCanvas.getContext('2d');
        //     marketCtx.font = "16px Arial";
        //     marketCtx.fillStyle = "#888";
        //     marketCtx.textAlign = "center";
        //     marketCtx.fillText("No market data available", marketCanvas.width / 2, marketCanvas.height / 2);
        // }

    </script>
@endsection