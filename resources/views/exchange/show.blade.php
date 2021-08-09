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
                            <ul class="list-group list-group-flush">
                                @if ($exchange->physical_address)
                                    <li class="list-group-item">
                                        <span>آدرس</span>
                                        <span>{{ $exchange->physical_address }}</span>
                                    </li>
                                @endif

                                @if ($mobiles = $exchange->contacts_mobiles)
                                    <li class="list-group-item">
                                        <span>تماس ها (موبایل)</span>
                                        <span>
                                            @foreach ($mobiles as $mobile)
                                                <a href="tel:{{ $mobile }}">{{ $mobile }}</a>
                                                @if (!$loop->last)
                                                    -
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif

                                @if ($emails = $exchange->contacts_emails)
                                    <li class="list-group-item">
                                        <span>تماس ها (ایمیل)</span>
                                        @foreach ($emails as $email)
                                            <a href="mailto:{{ $email }}">{{ $email }}</a>
                                            @if (!$loop->last)
                                                -
                                            @endif
                                        @endforeach
                                    </li>
                                @endif
                            </ul>
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
                                                    <td class="text-nowrap text-left">
                                                        {{ $crypto->pivot_buy_price_formatted }}</td>
                                                    <td class="text-nowrap text-left">
                                                        {{ $crypto->pivot_sell_price_formatted }}</td>
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
                                        <strong>{{ $exchange->rate_avg }}</strong>
                                        / 5
                                    </p>
                                </div>
                                <x-ratings :total="$exchange->rate_avg"></x-ratings>
                            </div>
                            <div class="col-md-6">
                                <div class="user-count-rate text-center pt-3">
                                    <p>
                                        <strong>{{ $exchange->ratings()->count() }}</strong>
                                        امتیاز کاربران
                                    </p>
                                    <a href="#reviews" class="btn btn-default-outline btn-block">
                                        ثبت امتیاز
                                    </a>
                                </div>
                            </div>
                            <livewire:exchange-rating :exchange="$exchange"></livewire:exchange-rating>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <livewire:reviews-section :exchange="$exchange" />
@endsection
