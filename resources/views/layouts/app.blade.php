<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Device Tracker</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <livewire:styles/>
</head>
<body class="antialiased">

<nav class="bg-white dark:bg-gray-900 w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600 h-16">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('main') }}" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 19.5h3m-6.75 2.25h10.5a2.25 2.25 0 002.25-2.25v-15a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 4.5v15a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Tracker</span>
        </a>
        <div class="flex md:order-2">
            @if (!auth()->check())
                @if(!request()->is('login'))
                    <a href="{{ route('login') }}"
                       class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">Login</a>
                @endif
            @else
                <div class="mt-0">
                    <livewire:auth.logout/>
                </div>
            @endif

            <button id="navbar-collapse-button" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                @if (auth()->user()?->role === 'admin')
                    <li>
                        <a href="{{ route('admin.users.index') }}">Users</a>
                        <a href="{{ route('admin.devices.index') }}">Devices</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container mx-auto">
    <x-notifications/>

    {{ $slot }}
</div>

@if (Session::has('notification'))
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            window.$wireui.notify({
                title: '{{  Session::get('notification.message') }}',
                icon: '{{ Session::get('notification.type') }}',
                timeout: 2000,
            })
        });
    </script>
@endif
<livewire:scripts/>
<wireui:scripts/>
<script src="//unpkg.com/alpinejs" defer></script>
</body>

<footer class="bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8"/>
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ date('Y') }} <a
                href="{{ route('main') }}" class="hover:underline">Ixobit™</a>. All Rights Reserved.</span>
    </div>
</footer>
</html>
