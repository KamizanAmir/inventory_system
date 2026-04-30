<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inventory System') }}</title>
    <!-- Fonts & Scripts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex h-screen bg-gray-100">

    <!-- SIDEBAR -->
    <div class="w-64 bg-gray-900 text-white flex flex-col shadow-2xl">
        <div class="h-16 flex items-center px-6 border-b border-gray-800 bg-gray-950">
            <span class="text-xl font-bold tracking-wider text-blue-400">INV-SYS</span>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>
            <!-- Add New Asset Link -->
            <a href="{{ route('assets.create') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('assets.create') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add New Asset
            </a>
            <!-- Add New Category Link -->
            <a href="{{ route('categories.create') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('categories.create') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <!-- Folder icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                </svg>
                Add Category
            </a>

            <!-- Scanner Link -->
            <a href="{{ route('checkout.create') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('checkout.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                </svg>
                Scanner
            </a>

            <!-- Procurement Plan (We will build this next!) -->
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-lg transition text-gray-400 hover:bg-gray-800 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                Procurement Plan
            </a>
        </nav>

        <!-- User Info & Logout -->
        <div class="p-4 border-t border-gray-800">
            <p class="text-sm text-gray-400 mb-2">Logged in as: <br><span
                    class="text-white font-bold">{{ Auth::user()->name }}</span></p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-red-400 hover:text-red-300 transition">
                    &rarr; Log Out
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Header Slot -->
        @isset($header)
            <header class="bg-white shadow z-10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
