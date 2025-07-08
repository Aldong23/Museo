<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data = "{isDarkMode : localStorage.getItem('dark') === 'false', isOpen: true, isMobile: false }"
    x-init = "$watch('isDarkMode', val => localStorage.setItem('dark', val))" x-bind:class="{ 'dark': isDarkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="/css/select2.css">
    @livewireStyles
    @stack('scripts')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-cloak>

    <main class="relative h-screen w-full flex font-montserrat">
        @include('components.admin.sidebar.sidebar')


        <div class="w-full h-full flex flex-col">
            @include('components.admin.navbar.navbar')
            <div class="relative w-full h-full overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </main>

    @livewireScripts
</body>

</html>
