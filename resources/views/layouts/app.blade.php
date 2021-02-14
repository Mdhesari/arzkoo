<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Arzkoo') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('assets/js/app.js') }}" defer></script>
</head>

<body>
    <div class="body-wrapper">

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')

            @if (isset($slot))
            {{ $slot }}
            @endif
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>