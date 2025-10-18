<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bachelor Meal Management System</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-200 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-lg py-4">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <a href="/" class="text-3xl font-extrabold text-gray-900">BMM System</a>
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <span class="text-gray-700 text-lg">Welcome, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition duration-300">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300">Register</a>
                    @endauth
                </div>
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-gray-600 focus:outline-none text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md py-2 mt-2">
                @auth
                    <span class="block px-4 py-2 text-gray-700">Welcome, <span class="font-semibold">{{ Auth::user()->name }}</span></span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 text-blue-600 hover:bg-gray-100">Login</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 text-green-600 hover:bg-gray-100">Register</a>
                @endauth
            </div>
        </nav>

        <!-- Main Content Area -->
        <main class="flex-grow container mx-auto px-4 py-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Success!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Error!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto px-4 text-center">
                &copy; {{ date('Y') }} Bachelor Meal Management System. All rights reserved.
            </div>
        </footer>
    </div>

    @vite('resources/js/app.js')
    <script>
        document.getElementById('mobile-menu-button').onclick = function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        };
    </script>
</body>
</html>
