<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            {{-- @if (session('success') || session('error'))
            <div x-data="{ open: true }" x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
                <div class="absolute inset-0 bg-black opacity-50" @click="open = false"></div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg z-10 relative max-w-md w-full">
                    <div class="mb-4">
                        @if (session('success'))
                            <h3 class="text-lg font-bold text-green-600 dark:text-green-400">Succes</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ session('success') }}</p>
                        @endif
                        @if (session('error'))
                            <h3 class="text-lg font-bold text-red-600 dark:text-red-400">Fout</h3>
                            <p class="text-gray-700 dark:text-gray-300">{{ session('error') }}</p>
                        @endif
                    </div>
                    <div class="flex justify-end">
                        <button @click="open = false" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                            Sluiten
                        </button>
                    </div>
                </div>
            </div>
            @endif --}}
        </div>
    </body>
</html>
