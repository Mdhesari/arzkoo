@extends('layouts.app')

@section('content')
    <section class="head-section" style="background:#50429d url('{{ asset($exchange->logo) }}') no-repeat 20% center">
        <div class="title-blog">
            <h1>
                {{ $exchange->persian_title . ' (' . $exchange->title . ') ' }}
            </h1>
        </div>
    </section>
    <section class="content-single">
        <div class="container">
            <div class="about-single">
                <div class="row">
                    <div class="about-right-column col-md-8 col-sm-7">
                        <div class="about-holder">
                            <h3>
                                درباره {{ $exchange->persian_title }}
                            </h3>
                            <p>
                                {{ $exchange->description }}
                            </p>
                        </div>
                        <div class="features-holder">
                            <h3>
                                ویژگی ها
                            </h3>
                            <ul class="features">
                                @foreach ($exchange->features as $feature)
                                    <li style="direction: rtl; text-align:right;">
                                        @if (boolval($feature['value']))
                                            <i class="fa fa-fw fa-check"></i>
                                        @else
                                            <i class="fa fa-fw fa-times"></i>
                                        @endif
                                        <span>{{ $feature['title'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tap-holder">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-currencies-tab" data-bs-toggle="pill"
                                        href="#pills-currencies" role="tab" aria-controls="pills-currencies"
                                        aria-selected="true">
                                        ارزهای دیجیتال
                                    </a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-peyment-tab" data-bs-toggle="pill" href="#pills-peyment"
                                        role="tab" aria-controls="pills-peyment" aria-selected="false">روش پرداخت</a>
                                </li> --}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-currencies" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <table>
                                        <thead>
                                            <th class="px-2">نام</th>
                                            <th class="px-2 text-nowrap">قیمت خرید</th>
                                            <th class="px-2 text-nowrap">قیمت فروش</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($cryptos as $crypto)
                                                <tr>
                                                    {{-- <td><i class="fab fa-{{ $crypto->symbol }}"></i></td> --}}
                                                    <td class="w-100">{{ $crypto->name }}</td>
                                                    <td class="text-nowrap text-left">{{ $crypto->pivot_buy_price_formatted }}</td>
                                                    <td class="text-nowrap text-left">{{ $crypto->pivot_sell_price_formatted }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $cryptos->links() }}
                                </div>
                                <div class="tab-pane fade" id="pills-peyment" role="tabpanel"
                                    aria-labelledby="pills-peyment-tab">
                                    <table>
                                        <tbody>
                                            <tr>
                                                <td><i class="fas fa-credit-card"></i></td>
                                                <td class="w-100">درگاه ملت</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="about-left-column col-md-4 col-sm-5">
                        <div class="broker-logo">
                            <a href="#">
                                <img src="assets/img/xcoins.png" alt="">
                            </a>
                        </div>
                        <div class="broker-rating row">
                            <div class="col-md-6">
                                <div class="rating">
                                    <p>
                                        <strong>4</strong>
                                        / 5
                                    </p>
                                </div>
                                <div class="stars">
                                    <i class="fa fa-star star-yellow"></i>
                                    <i class="fa fa-star star-yellow"></i>
                                    <i class="fa fa-star star-yellow"></i>
                                    <i class="fa fa-star star-yellow"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="user-count-rate text-center pt-3">
                                    <p>
                                        <strong>4</strong>
                                        امتیاز کاربران
                                    </p>
                                    <a href="#" class="btn btn-default-outline btn-block">
                                        ثبت امتیاز
                                    </a>
                                </div>
                            </div>
                            <div class=" col-md-12 bars">
                                <div class="bar">
                                    <div class="title">
                                        <span>راحتی استفاده </span>
                                    </div>
                                    <div class="rate-holder">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="label">
                                            <span>
                                                4.8
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar">
                                    <div class="title">
                                        <span>راحتی استفاده </span>
                                    </div>
                                    <div class="rate-holder">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="label">
                                            <span>
                                                4.8
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bar">
                                    <div class="title">
                                        <span>راحتی استفاده </span>
                                    </div>
                                    <div class="rate-holder">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 80%"
                                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="label">
                                            <span>
                                                4.8
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="reviews-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="rate-holder reviews-holder">
                        <div class="heading">
                            <h3>ثبت نظر </h3>
                        </div>
                        <div class="rate-inner">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">راحتی در استفاده</div>
                                    <div class="rating">
                                        <input type="radio" id="star15" name="rating1" value="5" /><label for="star15"
                                            data-toggle="tooltip" data-placement="top" title="خیلی خوب"></label>
                                        <input type="radio" id="star14" name="rating1" value="4" /><label for="star14"
                                            data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star13" name="rating1" value="3" /><label for="star13"
                                            data-toggle="tooltip" data-placement="top" title="متعادل"></label>
                                        <input type="radio" id="star12" name="rating1" value="2" /><label for="star12"
                                            data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star11" name="rating1" value="1" /><label for="star11"
                                            data-toggle="tooltip" data-placement="top" title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">راحتی در استفاده</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star25" name="rating2" value="5" /><label for="star25"
                                            data-toggle="tooltip" data-placement="top" title="خیلی خوب"></label>
                                        <input type="radio" id="star24" name="rating2" value="4" /><label for="star24"
                                            data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star23" name="rating2" value="3" /><label for="star23"
                                            data-toggle="tooltip" data-placement="top" title="متعادل"></label>
                                        <input type="radio" id="star22" name="rating2" value="2" /><label for="star22"
                                            data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star21" name="rating2" value="1" /><label for="star21"
                                            data-toggle="tooltip" data-placement="top" title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">راحتی در استفاده</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star35" name="rating3" value="5" /><label for="star35"
                                            data-toggle="tooltip" data-placement="top" title="خیلی خوب"></label>
                                        <input type="radio" id="star34" name="rating3" value="4" /><label for="star34"
                                            data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star33" name="rating3" value="3" /><label for="star33"
                                            data-toggle="tooltip" data-placement="top" title="متعادل"></label>
                                        <input type="radio" id="star32" name="rating3" value="2" /><label for="star32"
                                            data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star31" name="rating3" value="1" /><label for="star31"
                                            data-toggle="tooltip" data-placement="top" title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">راحتی در استفاده</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star45" name="rating4" value="5" /><label for="star45"
                                            data-toggle="tooltip" data-placement="top" title="خیلی خوب"></label>
                                        <input type="radio" id="star44" name="rating4" value="4" /><label for="star44"
                                            data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star43" name="rating4" value="3" /><label for="star43"
                                            data-toggle="tooltip" data-placement="top" title="متعادل"></label>
                                        <input type="radio" id="star42" name="rating4" value="2" /><label for="star42"
                                            data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star41" name="rating4" value="1" /><label for="star41"
                                            data-toggle="tooltip" data-placement="top" title="خیلی بد"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-holder">
                                <form action="#">
                                    <textarea name="" id="" cols="30" rows="5"></textarea>
                                    <div class="btns-holder">
                                        <button class="btn btn-default-outline" type="submit"> ثبت نظر </button>
                                        <a href="#" class="btn btn-default-outline">انصراف</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="reviews-holder">
                        <div class="heading">
                            <h3>بررسی ها </h3>
                        </div>
                        <div class="reviews">
                            <div class="review">
                                <div class="avatar">
                                    <img src="assets/img/persone.jfif" alt="">
                                </div>
                                <div class="review-body">
                                    <div class="review-header">
                                        <div class="name">
                                            <span>
                                                محمد حصاری
                                            </span>
                                        </div>
                                        <div class="stars">
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>
                                            طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند
                                            که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار
                                            فرما نمیدهد.
                                        </p>
                                    </div>
                                    <div class="review-footer">
                                        <div class="time">
                                            <span>
                                                2
                                            </span>
                                            ماه پیش
                                        </div>
                                        <div class="replay-review">
                                            <a href="#">پاسخ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="replay">
                                <span>پاسخ به حصاری</span>
                                <form action="">
                                    <div class="your-message">
                                        <textarea name="" id="" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="send-message">
                                        <button class="btn btn-default-outline" type="submit"> ارسال </button>
                                    </div>
                                </form>
                            </div>
                            <div class="review response">
                                <div class="avatar">
                                    <img src="assets/img/persone.jfif" alt="">
                                </div>
                                <div class="review-body">
                                    <div class="review-header">
                                        <div class="name">
                                            <span>
                                                محمد حصاری
                                            </span>
                                        </div>
                                        <div class="stars">
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star star-yellow"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="review-text">
                                        <p>
                                            طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند
                                            که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار
                                            فرما نمیدهد.
                                        </p>
                                    </div>
                                    <div class="review-footer">
                                        <div class="time">
                                            <span>
                                                2
                                            </span>
                                            ماه پیش
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="item-holder">
                        <div class="heading">
                            <h3>مقایسه </h3>
                        </div>
                        <div class="inner">
                            <ul class="items">
                                <li class="item">
                                    <div class="exchange-image">
                                        <a href="#">
                                            <img src="assets/img/xcoins.png" alt="">
                                        </a>
                                    </div>
                                    <div class="stars">
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="exchange-image">
                                        <a href="#">
                                            <img src="assets/img/xcoins.png" alt="">
                                        </a>
                                    </div>
                                    <div class="stars">
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="exchange-image">
                                        <a href="#">
                                            <img src="assets/img/xcoins.png" alt="">
                                        </a>
                                    </div>
                                    <div class="stars">
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star star-yellow"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
