@extends('layouts.app')

@section('content')
    <section class="head-section">
        <div class="title-blog">
            <h1>
                {{ $exchange->persian_title . ' (' . $exchange->title . ') ' }}
            </h1>
        </div>
        @if(!empty($exchange->site_with_query))
            <div class="actions my-4">
                <a href="{{ $exchange->site_with_query }}" class="btn btn-success btn-lg">ورود به صرافی</a>
            </div>
        @endif
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
                                <li class="list-group-item">
                                    <span>کارمزد</span>
                                    <span>%{{ $exchange->irr_min_fee_percent }}</span>
                                    -
                                    <span>%{{ $exchange->irr_max_fee_percent }}</span>
                                </li>
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
                                    <a class="nav-link" id="pills-payment-tab" data-bs-toggle="pill" href="#pills-payment"
                                        role="tab" aria-controls="pills-payment" aria-selected="false">روش پرداخت</a>
                                </li> --}}
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-currencies" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                     <div class="table-hodler">
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
                                                    <td>
                                                        <div class="crypto-holder d-flex align-items-center">
                                                            <div class="crypto-icon">
                                                                <img src="{{ $crypto->logo_full_url }}"/>
                                                            </div>
                                                            <span>
                                                                {{ $crypto->name }}
                                                            </span>
                                                        </div>
                                                    
                                                    </td>
                                                    <td class="text-nowrap">
                                                        {{ $crypto->pivot_buy_price_formatted }}</td>
                                                    <td class="text-nowrap">
                                                        {{ $crypto->pivot_sell_price_formatted }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                     </div>
                                  
                                </div>
                                <div class="tab-pane fade" id="pills-payment" role="tabpanel"
                                     aria-labelledby="pills-payment-tab">
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
                                <img src="{{ $exchange->logo_url }}" alt="{{ $exchange->name }}">
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
                                    <a href="@auth #reviews @else {{ route('login') }} @endauth"
                                       class="btn btn-default-outline btn-block">
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
    <livewire:reviews-section :exchange="$exchange"/>
@endsection
