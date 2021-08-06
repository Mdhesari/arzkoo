<div class="filters-main__card @if ($isFeatured) featured-box @endif
    box-cmp" @if ($isFeatured) data-label="پیشنهاد سایت" @endif>
    <div class="row align-items-center">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="header-right">
                <div class="images">
                    <img src="{{ asset($exchange->logo) }}" alt="{{ $exchange->name }}">
                </div>
                <div class="star">
                    <i class="fa fa-star star-yellow"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </div>
                <div class="info-star">
                    <span>1</span>
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
                @if ($exchange->pivot->currency != 'IRR')
                    <div class="price price_irr text-muted text-lead h6">
                        {{ $isBuy ? $exchange->irr_buy_price_formatted : $exchange->irr_sell_price_formatted }}</div>
                @endif
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="b-header-right">
                <div class="b-header-right__item">
                    <div class="title">پشتیبانی</div>
                    <div class="info">24 ساعته</div>
                </div>
                <div class="b-header-right__item">
                    <div class="title">پشتیبانی</div>
                    <div class="info">24 ساعته</div>
                </div>
                <div class="b-header-right__item">
                    <div class="title">پشتیبانی</div>
                    <div class="info">24 ساعته</div>
                </div>
                <div class="b-header-right__item">
                    <div class="title">پشتیبانی</div>
                    <div class="info">24 ساعته</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="b-header-left">
                <div class="b-header-left__inner">
                    <p>
                        قیمت برای <span>{{ arzkoo_money(1, 'USDT') }}</span>
                    </p>
                    <p>
                        @if ($isBestToBuy)
                        <strong>بهترین قیمت</strong>
                        @else
                            معمولا
                            <strong>
                                {{ $exchange->getBestAmountDiffPercent($isBuy ? $exchange->pivot->buy_price : $exchange->pivot->sell_price, $isBuy ? $bestExchange->pivot->buy_price : $bestExchange->pivot->sell_price) }}
                                درصد
                            </strong>
                            <p>بیشتر از بهترین قیمت</p>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="body-right">
                <p class="info-exchanges">لورم ایپسوم متن ساختگی با تولید
                    سادگی نامفهوم از صنعت
                    چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                    متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                    است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای
                    متنوع با هدف بهبود ابزارهای کاربردی می باشد.
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