<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-sky-100 via-white to-lime-100">
        <div class="w-full max-w-md px-4 sm:px-0">
            <div class="mb-6 text-center">
                <p class="text-xs font-semibold tracking-widest text-sky-700 uppercase">
                    Sistem Pendaftaran Magang
                </p>
                <p class="text-sm text-gray-600">
                    DPPPA Provinsi Sumatera Selatan
                </p>
            </div>

            <div class="bg-white/95 backdrop-blur shadow-xl rounded-2xl px-6 py-6 sm:px-8 sm:py-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>