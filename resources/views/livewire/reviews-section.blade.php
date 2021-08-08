<section class="reviews-section" id="reviews">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="rate-holder reviews-holder">
                    <div class="heading">
                        <h3>ثبت نظر </h3>
                    </div>
                    <form action="{{ route('exchanges.rating', $exchange) }}" method="POST">

                        <div class="rate-inner">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">راحتی در استفاده</div>
                                    <div class="rating">
                                        <input type="radio" id="star15" name="ease_of_use_range" value="5" /><label
                                            for="star15" data-toggle="tooltip" data-placement="top"
                                            title="خیلی خوب"></label>
                                        <input type="radio" id="star14" name="ease_of_use_range" value="4" /><label
                                            for="star14" data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star13" name="ease_of_use_range" value="3" /><label
                                            for="star13" data-toggle="tooltip" data-placement="top"
                                            title="متعادل"></label>
                                        <input type="radio" id="star12" name="ease_of_use_range" value="2" /><label
                                            for="star12" data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star11" name="ease_of_use_range" value="1" /><label
                                            for="star11" data-toggle="tooltip" data-placement="top"
                                            title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">احراز هویت سریع</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star25" name="verification_range" value="5" /><label
                                            for="star25" data-toggle="tooltip" data-placement="top"
                                            title="خیلی خوب"></label>
                                        <input type="radio" id="star24" name="verification_range" value="4" /><label
                                            for="star24" data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star23" name="verification_range" value="3" /><label
                                            for="star23" data-toggle="tooltip" data-placement="top"
                                            title="متعادل"></label>
                                        <input type="radio" id="star22" name="verification_range" value="2" /><label
                                            for="star22" data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star21" name="verification_range" value="1" /><label
                                            for="star21" data-toggle="tooltip" data-placement="top"
                                            title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">ارزش خرید</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star35" name="value_for_money_range" value="5" /><label
                                            for="star35" data-toggle="tooltip" data-placement="top"
                                            title="خیلی خوب"></label>
                                        <input type="radio" id="star34" name="value_for_money_range" value="4" /><label
                                            for="star34" data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star33" name="value_for_money_range" value="3" /><label
                                            for="star33" data-toggle="tooltip" data-placement="top"
                                            title="متعادل"></label>
                                        <input type="radio" id="star32" name="value_for_money_range" value="2" /><label
                                            for="star32" data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star31" name="value_for_money_range" value="1" /><label
                                            for="star31" data-toggle="tooltip" data-placement="top"
                                            title="خیلی بد"></label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="title-star">پشتیبانی</div>
                                    <div class="rating my-1">
                                        <input type="radio" id="star45" name="support_range" value="5" /><label
                                            for="star45" data-toggle="tooltip" data-placement="top"
                                            title="خیلی خوب"></label>
                                        <input type="radio" id="star44" name="support_range" value="4" /><label
                                            for="star44" data-toggle="tooltip" data-placement="top" title="خوب"></label>
                                        <input type="radio" id="star43" name="support_range" value="3" /><label
                                            for="star43" data-toggle="tooltip" data-placement="top"
                                            title="متعادل"></label>
                                        <input type="radio" id="star42" name="support_range" value="2" /><label
                                            for="star42" data-toggle="tooltip" data-placement="top" title="بد"></label>
                                        <input type="radio" id="star41" name="support_range" value="1" /><label
                                            for="star41" data-toggle="tooltip" data-placement="top"
                                            title="خیلی بد"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-holder">
                                @csrf
                                <textarea name="comment" id="comment" cols="30" rows="5"></textarea>
                                <div class="btns-holder">
                                    <button class="btn btn-default-outline" type="submit"> ثبت نظر </button>
                                    {{-- <a href="#" class="btn btn-default-outline">انصراف</a> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="reviews-holder">
                    <div class="heading">
                        <h3>بررسی ها </h3>
                    </div>
                    <div class="reviews my-4">
                        @if ($ratings->count() > 0)
                            @foreach ($ratings as $rating)
                                <div class="review">
                                    <div class="avatar">
                                        <img src="{{ $rating->user->full_image }}" alt="{{ $rating->user->name }}">
                                    </div>
                                    <div class="review-body">
                                        <div class="review-header">
                                            <div class="name mx-2">
                                                <span>
                                                    {{ $rating->user->name }}
                                                </span>
                                            </div>
                                            <x-ratings :total="$rating->average"></x-ratings>
                                        </div>
                                        <div class="review-text">
                                            <p>
                                                {{ $rating->comment }}
                                            </p>
                                        </div>
                                        <div class="review-footer">
                                            <div class="time">
                                                {{ $rating->created_at->toFormattedDateString() }}
                                            </div>
                                            {{-- <div class="replay-review">
                                                <a href="#">پاسخ</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">هنوز هیچ بررسی ثبت نشده است.</div>
                        @endif

                        {{-- <div class="replay">
                            <span>پاسخ به حصاری</span>
                            <form action="">
                                <div class="your-message">
                                    <textarea name="" id="" cols="30" rows="5"></textarea>
                                </div>
                                <div class="send-message">
                                    <button class="btn btn-default-outline" type="submit"> ارسال </button>
                                </div>
                            </form>
                        </div> --}}
                        {{-- <div class="review response">
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
                        </div> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 col-xs-12">
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
            </div> --}}
        </div>
    </div>
</section>
