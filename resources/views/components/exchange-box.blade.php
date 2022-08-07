<div class="filters-main__card @if ($isFeatured) featured-box @endif
    box-cmp" @if ($isFeatured) data-label="پیشنهاد سایت" @endif>
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="header-right">
                <a href="{{ route('exchanges.show', $exchange) }}">
                    <h2 class="mx-1 h3">{{ $exchange->persian_title }}</h2>
                </a>
                <div class="images">
                    <img src="{{ $exchange->logo_url }}" alt="{{ $exchange->name }}">
                </div>
                <div class="star">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star @if ($exchange->rate_avg >= $i) star-yellow @endif"></i>
                    @endfor
                </div>
                <div class="info-star">
                    <span>{{ $exchange->rate_avg }}</span>
                    امتیاز از
                    <span>5</span>
                    امتیاز
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="header-left">
                <div class="price">{{ $isBuy ? $exchange->buy_price_formatted : $exchange->sell_price_formatted }}
                </div>
                {{--                @if ($exchange->pivot->currency != 'IRR')--}}
                {{--                    <div class="price price_irr text-muted text-lead h6">--}}
                {{--                        {{ $isBuy ? $exchange->irr_buy_price_formatted : $exchange->irr_sell_price_formatted }}</div>--}}
                {{--                @endif--}}
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="b-header-right">
                <div class="b-header-right__item">
                    <div class="title">زمان احراز هویت</div>
                    <div class="info">{{ $exchange->verification_days_label }}</div>
                </div>
                <div class="b-header-right__item">
                    <div class="title">کارکرد آسان</div>
                    <div class="info">{{ getRangeLabel($exchange->ease_of_use_avg) }}</div>
                </div>
                <div class="b-header-right__item">
                    <div class="title">پشتیبانی</div>
                    <div class="info">{{ getRangeLabel($exchange->support_avg) }}</div>
                </div>

                <div class="b-header-right__item">
                    <div class="title">ارزش خرید</div>
                    <div class="info">{{ getRangeLabel($exchange->value_for_money_avg) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="b-header-left">
                <div class="b-header-left__inner">
                    <p>
                        قیمت برای <span>{{ arzkoo_money(1, $crypto->symbol) }}</span>
                    </p>
                    <p>
                        @if ($isBestToBuy)
                            <strong>بهترین قیمت</strong>
                        @else
                            معمولا
                            <strong>
                                {{
    $exchange->getBestAmountDiffPercent(
    $isBuy ? $exchange->pivot->buy_price : $exchange->pivot->sell_price,
    $isBuy ? $bestExchange->pivot->buy_price : $bestExchange->pivot->sell_price)
     }}
                                درصد
                            </strong>
                    <p><span>{{ $isBuy ? 'کمتر':'بیشتر'  }}</span> از بهترین قیمت</p>
                    @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="body-right">
                <p class="info-exchanges">
                    {{ \Str::limit($exchange->description, 524, '...') }}
                </p>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="body-left text-center">
                <a class="link-site clickable" href="{{ route('exchanges.show', $exchange) }}">
                    اطلاعات بیشتر
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="footer-right text-right">
                <i class="fas fa-shield-check" data-toggle="tooltip" data-placement="top" title=" 1 نمایش پیشفرض"></i>
                <i class="fa fa-temperature-frigid" data-toggle="tooltip" data-placement="top"
                   title=" 2 نمایش پیشفرض"></i>
                <i class="fa fa-link" data-toggle="tooltip" data-placement="top" title=" 3 نمایش پیشفرض"></i>
            </div>
        </div>
    </div>
</div>
