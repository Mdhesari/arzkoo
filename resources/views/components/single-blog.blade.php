<div>
    <div class="about-us-heade blog-header text-center">
        <div class="about-us-title blog-title">
            <h1>
                {{ $post->title }}
            </h1>
        </div>
        <div class="time-release">
            <time datetime="2021-01-02">{{ $post->created_at->toFormattedDateString() }}</time>
        </div>
    </div>
    <div class="blog-desc">
        <div class="need-time">
            <i class="fa fa-clock-o"></i>
            <span>خواندن : </span>
            <span> 5 </span>
            <span> دقیقه </span>
        </div>
        <div class="author">
            <i class="fas fa-user-circle"></i>
            <span>نویسنده : </span>
            <span>
                {{ optional($post->authorId)->name }}
            </span>
        </div>
    </div>
    <div class="post-inner">
        <div class="post-content">
            <div class="image-holder" style="background-image: url('{{ $post->fullImageUrl }}');">
            </div>
            {!! $post->body !!}
        </div>
    </div>

    <x-post-comments :post="$post"></x-post-comments>
</div>
