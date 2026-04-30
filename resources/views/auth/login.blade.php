<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Inventory System</title>
    <!-- Include Tailwind via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased flex min-h-screen bg-white">

    <!-- LEFT SIDE: Branding & Graphic (Hidden on mobile) -->
    <div class="hidden lg:flex lg:w-1/2 bg-gray-900 items-center justify-center relative overflow-hidden">
        <!-- Subtle background decoration -->
        <div
            class="absolute -top-32 -left-32 w-96 h-96 border-4 rounded-full border-opacity-10 border-t-8 border-blue-500">
        </div>
        <div
            class="absolute -bottom-32 -right-32 w-96 h-96 border-4 rounded-full border-opacity-10 border-b-8 border-blue-500">
        </div>

        <div class="z-10 text-center px-12">
            <!-- Box Icon in White -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                stroke="currentColor" class="w-24 h-24 mx-auto text-blue-500 mb-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
            </svg>
            <h1 class="text-5xl font-bold text-white mb-4 tracking-wider">INV-SYS</h1>
            <p class="text-gray-400 text-lg">Centralized Asset & Tool Management</p>
        </div>
    </div>

    <!-- RIGHT SIDE: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 bg-gray-50 lg:bg-white">
        <div class="w-full max-w-md">

            <!-- Mobile Header (Only shows on small screens) -->
            <div class="mb-10 lg:hidden text-center">
                <h1 class="text-3xl font-bold text-blue-600 mb-2 tracking-wider">INV-SYS</h1>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                <p class="text-gray-500">Please sign in to access the dashboard.</p>
            </div>

            <!-- Session Status (e.g. Password reset success messages) -->
            <x-auth-session-status class="mb-4 text-green-600 font-bold" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username"
                        class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-500 transition duration-150">Forgot
                                password?</a>
                        @endif
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">Remember me</label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    Sign In to Dashboard
                </button>
            </form>

        </div>
    </div>

</body>

</html>
