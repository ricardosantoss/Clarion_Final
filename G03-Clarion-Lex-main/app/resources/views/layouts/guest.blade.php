<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-f">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">

        {{--
            1. Largura diminuída para max-w-4xl
            2. Grid alterado para md:grid-cols-5 (para permitir a proporção 40/60)
        --}}
        <div
            class="w-full max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-5">

            {{--
                3. Adicionado gradiente vertical (from-gray-900 to-gray-800)
                4. Definido o 'col-span' como 2 de 5 (40% da largura)
            --}}
            <div
                class="hidden md:block bg-gradient-to-b from-gray-900 to-gray-800 text-gray-300 p-12 relative text-center md:col-span-2">

                <div class="absolute inset-0 z-0 opacity-50">
                    <svg class="w-full h-full" viewBox="0 0 400 600" preserveAspectRatio="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0 H400 V300 C400 300 350 400 200 400 C50 400 0 300 0 300 Z" fill="#1F2937" />
                    </svg>
                </div>

                <div class="relative z-10 flex flex-col justify-between h-full">
                    <div>
                        <h2 class="text-4xl font-bold text-white"><strong>Dr. M.</strong></h2>
                        <p class="mt-4 text-lg">
                            Criação automatizada de peças jurídicas e gestão eficiente para escritórios de advocacia,
                            tudo em um só lugar.
                        </p>
                    </div>

                    <div class="text-sm mt-8">
                        {{-- O slot $leftFooter será preenchido pelas views filhas --}}
                        {{ $leftFooter ?? '' }}
                    </div>
                </div>
            </div>

            {{--
                5. Definido o 'col-span' como 3 de 5 (60% da largura)
            --}}
            <div class="p-8 md:p-12 md:col-span-3">
                {{ $slot }}
            </div>
        </div>

    </div>
</body>

</html>
