<div class="row blogs">
    @foreach($posts as $post)
        <x-blog-list-item :post="$post" :isFull="$loop->first"></x-blog-list-item>
    @endforeach

    <div class="pagination-links my-4 mx-auto">
        {{ $posts->links() }}
    </div>
</div>
