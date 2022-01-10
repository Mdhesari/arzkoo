@extends('layouts.app')

@section('content')
    <section class="box-bottom-header py-2">
        <div class="container">
            <div class="row">
                {{--                <div class="col-lg-12 col-md-12 col-sm-12">--}}
                {{--                    <nav aria-label="breadcrumb">--}}
                {{--                        <ol class="breadcrumb">--}}
                {{--                            <li class="breadcrumb-item clickable"><a href="index.html">صفحه اصلی</a></li>--}}
                {{--                            <li class="breadcrumb-item active" aria-current="page">صرافی ها</li>--}}
                {{--                        </ol>--}}
                {{--                    </nav>--}}
                {{--                </div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title">صرافی ها و کارگزاران ارزهای پایه را مشاهده کنید</h1>
                    <p class="info-title">برای محدود کردن جستجوی خود از فیلترهای زیر استفاده کنید .</p>
                </div>
            </div>
        </div>
    </section>
    <section class="exchanges-main py-4">
        <div class="container">
            <div class="row">
                {{--                TODO: complete filters --}}
                {{--                <div class="col-lg-3 col-md-3 col-sm-12">--}}
                {{--                    <aside class="filter-aside">--}}
                {{--                        <div class="navbar-filter box-cmp">--}}
                {{--                            <span class="navbar-filter__text">فیلترها</span>--}}
                {{--                            <i class="fas fa-search-dollar"></i>--}}
                {{--                        </div>--}}
                {{--                        <div class="filter-aside__box box-cmp">--}}
                {{--                            <h5 class="title-filter"> ارزهای پایه</h5>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> BitCoin </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Ethereum </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Ripple (XRP) </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Stellar Lumens </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> BitCoin </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Ethereum </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Ripple (XRP) </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter">--}}
                {{--                                    <input class="filter" type="checkbox">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> Stellar Lumens </span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                        <div class="filter-aside__box box-cmp">--}}
                {{--                            <h5 class="title-filter"> رتبه بندی </h5>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter" for="star4">--}}
                {{--                                    <input class="filter" type="radio" id="star4" name="star">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item">--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    و بیشتر--}}
                {{--                                </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter" for="star3">--}}
                {{--                                    <input class="filter" type="radio" id="star3" name="star">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item">--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    و بیشتر </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter" for="star2">--}}
                {{--                                    <input class="filter" type="radio" id="star2" name="star">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item">--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    و بیشتر--}}
                {{--                                </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter" for="star1">--}}
                {{--                                    <input class="filter" type="radio" id="star1" name="star">--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item">--}}
                {{--                                    <i class="fa fa-star star-yellow"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    <i class="fa fa-star"></i>--}}
                {{--                                    و بیشتر--}}
                {{--                                </span>--}}
                {{--                            </div>--}}
                {{--                            <div class="filter-aside__box__item">--}}
                {{--                                <label class="label-filter" for="star0">--}}
                {{--                                    <input class="filter" type="radio" id="star0" name="star" checked>--}}
                {{--                                    <span class="slider-filter"></span>--}}
                {{--                                </label>--}}
                {{--                                <span class="name-item"> تمامی امتیازات </span>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </aside>--}}
                {{--                </div>--}}
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="content-aside">
                        <div class="content-aside__inner">
                            <div class="row">
                                @foreach ($exchanges as $exchange)
                                    @php $isFeatured = $exchange->isFeatured() @endphp
                                    <div class="col-6 col-lg-3 col-sm-6">
                                        <div class="box box-cmp @if ($isFeatured) featured-box @endif"
                                             @if ($isFeatured) data-label="پیشنهاد
                                            سایت"
                                            @endif>
                                            <a href="{{ route('exchanges.show', $exchange) }}"></a>
                                            <div class="box__img">
                                                <img class="img-fluid" src="{{ asset($exchange->logo) }}"
                                                     alt="{{ $exchange->title }}">
                                            </div>
                                            <div class="box__star">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa fa-star @if ($exchange->rate_avg >= $i) star-yellow @endif"></i>
                                                @endfor
                                            </div>
                                            <h2 class="box__name">
                                                {{ $exchange->persian_title }}
                                            </h2>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
