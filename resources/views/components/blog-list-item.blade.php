<div class="{{ $class }}">
    <article>
        <div class="inner trend">
            <a href="{{ route('blog.show', $post) }}" class="fulllink"></a>
            <div class="thumbnail" style="background-image: url('{{ $post->fullImageUrl }}');">
            </div>
            <div class="blog-content">
                <div class="blog-heading">
                    <h2>
                        {{ $post->title }}
                    </h2>
                </div>
                <div class="blog-desc">
                    <p>
                        {{ \Str::limit($post->excerpt, $limit = 150, $end = '...') }}
                    </p>
                </div>
                {{-- <div class="read-time">
                    <i class="fa fa-clock-o"></i>
                    <span>
                        3
                    </span>
                    دقیقه وقت خواندن
                </div> --}}
            </div>
        </div>
    </article>
</div>
