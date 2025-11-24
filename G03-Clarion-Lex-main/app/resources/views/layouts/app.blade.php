<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar-bg {
            background-color: #2B3445;
        }

        .sidebar-active {
            background-color: #4A5568;
            color: white;
        }

        .content-bg {
            background-color: #F4F7FE;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: true }" class="relative min-h-screen content-bg">
        <header
            class="fixed top-0 left-0 right-0 z-40 flex items-center justify-between h-20 px-6 bg-white border-b border-gray-200">

            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <a href="{{ route('dashboard') }}" class="flex items-center ml-4">
                    <img src="{{ asset('storage/img/logo.png') }}" alt="Logo" class="h-8 w-auto">
                    <strong class="ml-3 text-2xl text-gray-900 font-black">Dr. M.</strong>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-gray-700">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                </button>

                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = ! open" class="flex items-center text-sm focus:outline-none">
                        <img class="h-8 w-8 rounded-full object-cover"
                            src="{{ asset('storage/img/avatar.png') }}"
                            alt="{{-- auth()->user()->name --}}">
                        <span class="hidden md:inline-block ml-2 text-gray-700">{{-- auth()->user()->name --}}</span>
                    </button>

                    <div x-show="open" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                        style="display: none;" @click="open = false">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form> --}}
                    </div>
                </div>
            </div>

        </header>

        <aside
            class="fixed z-30 top-20 m-4 p-2 rounded-2xl sidebar-bg text-gray-300 transition-all duration-300 h-[calc(100vh-6.5rem)] overflow-y-auto"
            :class="sidebarOpen ? 'w-64' : 'w-20'">
            <nav class="flex-1 px-2 py-2 space-y-2">
                <span class="px-2 py-1 text-xs font-semibold uppercase text-gray-400" x-show="sidebarOpen">Gestão</span>

                <a href="{{ route('dashboard') }}" wire:navigate
                    class="flex items-center p-2 rounded-lg hover:bg-gray-700 hover:text-white"
                    :class="{
                        'sidebar-active': {{ request()->routeIs('dashboard') ? 'true' : 'false' }},
                        'justify-center': !sidebarOpen
                    }">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    <span class="ml-3" x-show="sidebarOpen">Dashboard</span>
                </a>

                <span class="px-2 py-1 text-xs font-semibold uppercase text-gray-400 pt-4"
                    x-show="sidebarOpen">Revisão</span>

                <a href="{{ route('peticoes.gerar') }}" wire:navigate
                    class="flex items-center p-2 rounded-lg hover:bg-gray-700 hover:text-white"
                    :class="{
                        'sidebar-active': {{ request()->routeIs('peticoes.gerar') ? 'true' : 'false' }},
                        'justify-center': !sidebarOpen
                    }">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m3.75 9v6m-3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="ml-3" x-show="sidebarOpen">Gerar Petição</span>
                </a>

                <a href="{{ route('peticoes.revisao') }}" wire:navigate
                    class="flex items-center p-2 rounded-lg hover:bg-gray-700 hover:text-white"
                    :class="{
                        'sidebar-active': {{ request()->routeIs('peticoes.revisao') ? 'true' : 'false' }},
                        'justify-center': !sidebarOpen
                    }">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                    </svg>
                    <span class="ml-3" x-show="sidebarOpen">Revisão Jurídica</span>
                </a>

                <a href="{{ route('peticoes.historico') }}" wire:navigate
                    class="flex items-center p-2 rounded-lg hover:bg-gray-700 hover:text-white"
                    :class="{
                        'sidebar-active': {{ request()->routeIs('peticoes.historico') ? 'true' : 'false' }},
                        'justify-center': !sidebarOpen
                    }">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 8.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v8.25A2.25 2.25 0 006 16.5h2.25m8.25-8.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-7.5A2.25 2.25 0 018.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 00-2.25 2.25v6" />
                    </svg>
                    <span class="ml-3" x-show="sidebarOpen">Histórico de Petições</span>
                </a>
            </nav>
        </aside>

        <div class="flex flex-col flex-1 min-h-screen pt-20 transition-all duration-300"
            :class="sidebarOpen ? 'ml-[19rem]' : 'ml-[8rem]'">
            <main class="flex-1 p-6 md:p-8">

                @if (isset($header))
                    <header class="mb-4">
                        {{ $header }}
                    </header>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
