<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! Twitter::generate() !!}
{!! JsonLd::generate() !!}

<!-- Styles -->
    <link rel="canonical" href="{{ url()->current() }}"/>
    <link rel="stylesheet" href="{{ mix('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ mix('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/arzkoo.css') }}">
    @if ($logo = setting('site.logo'))
        <link rel="icon" href="{{ \Storage::url($logo) }}" type="image/png">
    @endif

    @stack('add_styles')

    @livewireStyles

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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

{{--<!BEGIN RAYCHAT CODE-->--}}
<script type="text/javascript">!function () {
        function t() {
            var t = document.createElement("script");
            t.type = "text/javascript", t.async = !0, localStorage.getItem("rayToken") ? t.src = "https://app.raychat.io/scripts/js/" + o + "?rid=" + localStorage.getItem("rayToken") + "&href=" + window.location.href : t.src = "https://app.raychat.io/scripts/js/" + o + "?href=" + window.location.href;
            var e = document.getElementsByTagName("script")[0];
            e.parentNode.insertBefore(t, e)
        }

        var e = document, a = window, o = "9f26960a-1a71-4711-bcbb-dab8b5fe0e78";
        "complete" == e.readyState ? t() : a.attachEvent ? a.attachEvent("onload", t) : a.addEventListener("load", t, !1)
    }();</script>
{{--<!END RAYCHAT CODE-->--}}

@stack('modals')

@livewireScripts
</body>

</html>
