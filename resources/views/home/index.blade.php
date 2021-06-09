@extends('layouts.app')

@section('content')
<section class="searchly">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1 class="title-section m-30">
                    بهترین مکان را برای خرید ارز دیجیتال پیدا کن
                </h1>
            </div>
        </div>
        <div class="row search-holder">
            <div class="search-item col-md-4 col-xs-12">
                <div class="switch-toggle">
                    <a href="#" class="toggle clickable active" onclick="toggle(this)">خرید</a>
                    <a href="#" class="toggle clickable" onclick="toggle(this)">فروش</a>
                </div>
            </div>
            <div class="search-item col-md-5 col-xs-12">
                <div class="dropholder">
                    <div class="dropdown">
                        <p>عرض مورد نظر خود را انتخاب کنید</p>
                    </div>
                    <ul class="dropdownMenu">
                        <li>
                            <a href="#">
                                <i class="fab fa-bitcoin bitcoin"></i>
                                <span>بیتکوین</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-bitcoin bitcoin"></i>
                                <span>بیتکوین</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-bitcoin bitcoin"></i>
                                <span>بیتکوین</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-bitcoin bitcoin"></i>
                                <span>بیتکوین</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-bitcoin bitcoin"></i>
                                <span>بیتکوین</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="search-item col-md-3 col-xs-12">
                <a class="btn btn-search btn-primary btn-lg btn-block">
                    <span>
                        جستجو
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </span>
                </a>
            </div>
        </div>
        <div class="row recommendations">
            <div class="recommendations-title text-center ">
                <h2 class="mt-5">کریپتو در آخرین لحظه 1702 نرخ ارز را برای شما بررسی کرده است</h2>
            </div>
            <div class="live-prices m-30">
                <div class="item">
                    <div class="icon">
                        <i class="fab fa-btc"></i>
                    </div>
                    <div class="detail">
                        <strong>800 میلیون</strong>
                        <p>بهترین قیمت بیتکون در کریپتو</p>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <i class="fab fa-btc"></i>
                    </div>
                    <div class="detail">
                        <strong>800 میلیون</strong>
                        <p>بهترین قیمت بیتکون در کریپتو</p>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <i class="fab fa-btc"></i>
                    </div>
                    <div class="detail">
                        <strong>800 میلیون</strong>
                        <p>بهترین قیمت بیتکون در کریپتو</p>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <i class="fab fa-btc"></i>
                    </div>
                    <div class="detail">
                        <strong>800 میلیون</strong>
                        <p>بهترین قیمت بیتکون در کریپتو</p>
                    </div>
                </div>
                <div class="item">
                    <div class="icon">
                        <i class="fab fa-btc"></i>
                    </div>
                    <div class="detail">
                        <strong>800 میلیون</strong>
                        <p>بهترین قیمت بیتکون در کریپتو</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="exchanges py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="title-section">
                    مقایسه بیشتر از 50 صرافی ارزهای دیجیتال
                </h2>
            </div>
        </div>
        <div class="row exchange-holder">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/1.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/2.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/3.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/4.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/4.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="inner-slider">
                            <a href="#">
                                <img src="{{ asset('assets/img/5.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<section class="compare py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="title-section">
                    جستجو و مقایسه کنید
                </h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="compare__right">
                    <div class="compare__right__item">
                        <div class="compare__right__item__right">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="compare__right__item__left">
                            <h3>بهترین قیمت را پیدا کنید</h3>
                            <p>در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                                منتظر درخواست خرید ...</p>
                        </div>
                    </div>
                    <div class="compare__right__item">
                        <div class="compare__right__item__right">
                            <i class="fas fa-star-half"></i>
                        </div>
                        <div class="compare__right__item__left">
                            <h3>امتیازها را بررسی کنید</h3>
                            <p>در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                                منتظر درخواست خرید ...</p>
                        </div>
                    </div>
                    <div class="compare__right__item">
                        <div class="compare__right__item__right">
                            <i class="fas fa-check-square"></i>
                        </div>
                        <div class="compare__right__item__left">
                            <h3>ویژگی ها را مقایسه کنید</h3>
                            <p>در این حالت شما ارز دیجیتال خود را با قیمت پیشنهادی خودتان ثبت می کنید و
                                منتظر درخواست خرید ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="compare__left">
                    <img class="img-fluid" src="{{ asset('assets/img/miniwire-search') }}.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="lists-exchanges py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="title-section">
                    ویژگی ها و خصوصیات بیش از 50 صرافی را بررسی کنید
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <ul class="lists-exchanges__inner">
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی تهران</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی آقای
                            بنایی</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی سعادت
                            آباد</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی کیش</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی مدرسان
                            شریف</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <ul class="lists-exchanges__inner">
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی تهران</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی آقای
                            بنایی</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی سعادت
                            آباد</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی کیش</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی مدرسان
                            شریف</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <ul class="lists-exchanges__inner">
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی تهران</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی آقای
                            بنایی</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی سعادت
                            آباد</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی کیش</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی مدرسان
                            شریف</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <ul class="lists-exchanges__inner">
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی تهران</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی آقای
                            بنایی</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی سعادت
                            آباد</a></li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/bc.png') }}" alt="">صرافی کیش</a>
                    </li>
                    <li><a class="clickable" href="#"><img src="{{ asset('assets/img/br.png') }}" alt="">صرافی مدرسان
                            شریف</a></li>
                </ul>
            </div>
            <a class="clickable lists-exchanges__more" href="#">
                مشاهده بیشتر
                <i class="fad fa-angle-double-left"></i>
            </a>
        </div>
    </div>
</section>
<section class="whats-crypto py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="title-section">
                    کریپتو چیست ؟
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="whats-crypto__info">
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                        گرافیک
                        است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط
                        فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                        کتابهای
                        زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد
                    </p>
                    <p>تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و
                        فرهنگ
                        پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود
                        در
                        ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی
                        دستاوردهای
                        اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
