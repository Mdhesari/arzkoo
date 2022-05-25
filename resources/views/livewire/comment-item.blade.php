<div class="review">
    <div class="avatar">
        <i class="fas fa-user-circle"></i>
    </div>
    <div class="review-body">
        <div class="review-header">
            <div class="name">
                            <span>
                                {{ $comment->commentator->name  }}
                            </span>
            </div>
        </div>
        <div class="review-text">
            <p>
                {!! $comment->comment !!}
            </p>
        </div>
        <div class="review-footer">
            <div class="time">
                {{ verta($comment->created_at)->formatDifference()  }}
            </div>
{{--            <div class="replay-review">--}}
            {{--                <a href="#">پاسخ</a>--}}
            {{--            </div>--}}
        </div>
    </div>

</div>
