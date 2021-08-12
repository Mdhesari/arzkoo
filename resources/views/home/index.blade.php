@extends('layouts.app')

@section('content')
    <x-searchly></x-searchly>
    <x-section-exchanges></x-section-exchanges>
    <section class="compare py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="title-section">
                        {{ setting('landing.title', 'جستجو و مقایسه کنید') }}
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
                                <p>
                                    {{ setting('landing.compare.bestPriceDescription') }}
                                </p>
                            </div>
                        </div>
                        <div class="compare__right__item">
                            <div class="compare__right__item__right">
                                <i class="fas fa-star-half"></i>
                            </div>
                            <div class="compare__right__item__left">
                                <h3>امتیازها را بررسی کنید</h3>
                                <p>
                                    {{ setting('landing.compare.bestRateDescription') }}
                                </p>
                            </div>
                        </div>
                        <div class="compare__right__item">
                            <div class="compare__right__item__right">
                                <i class="fas fa-check-square"></i>
                            </div>
                            <div class="compare__right__item__left">
                                <h3>ویژگی ها را مقایسه کنید</h3>
                                <p>
                                    {{ setting('landing.compare.bestFeatureDescription') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="compare__left">
                        <img class="img-fluid" src="{{ asset('assets/img/miniwire-search') }}"
                            alt="{{ config('app.name') }}">
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
                        ویژگی ها و خصوصیات بیش از {{ $exchanges->count() }} صرافی را بررسی کنید
                    </h2>
                </div>
            </div>
            <div class="row">
                @foreach ($exchanges as $exchange)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                        <div class="list-exchange">
                            <a class="clickable" href="{{ route('home') }}">
                                <img src="{{ asset($exchange->logo) }}" alt="{{ $exchange->title }}">
                                {{ $exchange->persian_title }}
                            </a>
                        </div>
                    </div>
                @endforeach
                <a class="clickable lists-exchanges__more" href="{{ route('exchanges.home') }}">
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
                        {{ setting('landing.Abouttitle') }}
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="whats-crypto__info">
                        {{ setting('landing.Aboutdescription') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
