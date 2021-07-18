@extends('layouts.app')

@section('content')
    <x-searchly></x-searchly>
    <x-section-exchanges :exchanges="$exchanges"></x-section-exchanges>
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
                        <img class="img-fluid" src="{{ asset('assets/img/miniwire-search') }}" alt="">
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
                        @foreach ($exchanges as $exchange)

                            <li>
                                <a class="clickable" href="#">
                                    <img src="{{ asset($exchange->logo) }}" alt="{{ $exchange->title }}">
                                    {{ $exchange->persian_title }}
                                </a>
                            </li>

                        @endforeach

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