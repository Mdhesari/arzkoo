<div class="reviews-holder">
    <div class="heading">
        <h3>نظرات</h3>
    </div>
    <div class="reviews">
        @foreach($comments as $comment)
            <livewire:comment-item :comment="$comment"/>
        @endforeach

{{--        <div class="review response">--}}
{{--            <div class="avatar">--}}
{{--                <i class="fas fa-user-circle"></i>--}}
{{--            </div>--}}
{{--            <div class="review-body">--}}
{{--                <div class="review-header">--}}
{{--                    <div class="name">--}}
{{--                            <span>--}}
{{--                                محمد حصاری--}}
{{--                            </span>--}}
{{--                    </div>--}}
{{--                    <div class="stars">--}}
{{--                        <i class="fa fa-star star-yellow"></i>--}}
{{--                        <i class="fa fa-star star-yellow"></i>--}}
{{--                        <i class="fa fa-star star-yellow"></i>--}}
{{--                        <i class="fa fa-star star-yellow"></i>--}}
{{--                        <i class="fa fa-star"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="review-text">--}}
{{--                    <p>--}}
{{--                        طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند--}}
{{--                        که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار--}}
{{--                        فرما نمیدهد.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="review-footer">--}}
{{--                    <div class="time">--}}
{{--                            <span>--}}
{{--                                2--}}
{{--                            </span>--}}
{{--                        ماه پیش--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="replay">--}}
{{--            <span>پاسخ به حصاری</span>--}}
{{--            <form action="">--}}
{{--                <div class="your-message">--}}
{{--                    <textarea name="" id="" cols="30" rows="5"></textarea>--}}
{{--                </div>--}}
{{--                <div class="send-message">--}}
{{--                    <button class="btn btn-default-outline" type="submit"> ارسال</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
    </div>
</div>
