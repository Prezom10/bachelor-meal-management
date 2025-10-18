<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <div class="min-h-screen flex flex-col items-center justify-center p-6">
            <header class="w-full max-w-4xl mb-8">
                @if (Route::has('login'))
                    <nav class="flex justify-end space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="flex flex-col items-center justify-center flex-1 w-full max-w-4xl">
                <h1 class="text-5xl font-bold mb-4 text-center">Welcome to {{ config('app.name', 'Laravel') }}</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 text-center">Your journey starts here.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold mb-2">Get Started</h2>
                        <p class="text-gray-700 dark:text-gray-300">Explore the documentation to learn more about Laravel.</p>
                        <a href="https://laravel.com/docs" target="_blank" class="text-blue-500 hover:underline mt-4 block">Read Documentation &rarr;</a>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                        <h2 class="text-2xl font-semibold mb-2">Laracasts</h2>
                        <p class="text-gray-700 dark:text-gray-300">Watch video tutorials to master Laravel development.</p>
                        <a href="https://laracasts.com" target="_blank" class="text-blue-500 hover:underline mt-4 block">Watch Laracasts &rarr;</a>
                    </div>
                </div>
            </main>

            <footer class="w-full max-w-4xl mt-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </footer>
        </div>
    </body>
</html>