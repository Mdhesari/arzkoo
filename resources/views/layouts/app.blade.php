<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}

    <title>{{ config('app.name', 'Arzkoo') }}</title>

    <!-- Styles -->
    <link rel="canonical" href="{{ config('app.url') }}" />
    <link rel="stylesheet" href="{{ mix('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @stack('add_styles')

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @stack('add_scripts')
</head>

<body>
    <div class="body-wrapper">

        <!-- Header -->
        <header>
            <div class="darklayer" id="darkLayer" onclick="closeMenu()"></div>
            <div class="container">

                @include('partials.top-header')

            </div>
        </header>

        <!-- Page Content -->
        <main>

            @if ($message = session('success'))
                <div class="alert alert-success m-0">{{ $message }}</div>
            @endif

            @yield('content')

            @if (isset($slot))
                {{ $slot }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">

                @include('partials.footer')

            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
