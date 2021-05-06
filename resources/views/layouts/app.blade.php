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

        <!-- Header -->
        <header>
            <div class="darklayer" id="darkLayer" onclick="closeMenu()"></div>
            <div class="container">
                <div class="top-header">
                    <div class="right-header">
                        <button class="burger-btn" id="burgerBtn" onclick="openMenu()">
                            <i class="fas fa-bars"></i>
                        </button>
                        <div class="logo-holder">
                            <a href="index.html">
                                <img src="assets/img/logo.png" alt="">
                            </a>
                        </div>
                        <nav class="main-menu" id="mainMenu">
                            <h2 class="d-none">منوی کاربری ارزکو</h2>
                            <ul>
                                <li><a href="filter-page.html" class="active">مقایسه قیمت</a></li>
                                <li><a href="exchanges.html">صرافی ها </a></li>
                                <li><a href="blog.html">بلاگ </a></li>
                                <li><a href="live-prices.html">قیمت لحظه ای</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="actions">
                        <a href="otp.html">
                            ثبت نام
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')

            @if (isset($slot))
            {{ $slot }}
            @endif
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="footer__box">
                            <a class="footer__box__logo" href="#">
                                <img class="img-fluid" src="./assets/img/logo-white.png" alt="">
                            </a>
                            <div class="footer__box__info">
                                <p class="footer__box__info__text"> ورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                    صنعت چاپ و با استفاده از طراحان گرافیک
                                    است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای
                                    شرایط
                                    فعلی تکنولوژی زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و
                                    متخصصان را می طلبد</p>
                                <ul class="social">
                                    <li><a href="#">
                                            <i class="fab fa-telegram-plane clickable"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fab fa-twitter clickable"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fab fa-linkedin-in clickable"></i>
                                        </a></li>
                                    <li><a href="#">
                                            <i class="fab fa-instagram clickable"></i>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="footer__box">
                            <h4 class="footer__box__title">
                                با ما در ارتباط باشید
                            </h4>
                            <div class="footer__box__links">
                                <a href="about-us.html">درباره ما</a>
                                <a href="#">مطبوعات خبری</a>
                                <a href="blog.html">بلاگ ها</a>
                                <a href="#">پشتیبانی</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="footer__box">
                            <h4 class="footer__box__title">
                                عضویت در خبرنامه
                            </h4>
                            <div class="footer__box__newsletter">
                                <form action="" class="footer__box__newsletter__form">
                                    <input type="email" placeholder="ایمیل خود را وارد کنید">
                                    <button class="clickable" type="submit">عضویت</button>
                                </form>
                                <p class="footer__box__newsletter__text">
                                    با خبرنامه ما از جدیدترین اتفاقات ارزهای دیجیتال با خبر شوید و به روز باشید .
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="bottom-footer__right">
                            <p> @کلیه حقوق این سایت متعلق به (فروشگاه.....) می‌باشد و هرگونه کپی برداری پیگرد قانونی
                                دارد .</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="bottom-footer__left">
                            <a href="legal.html"> شرایط و ضوابط</a>
                            <a href="legal.html">حریم خصوصی</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
