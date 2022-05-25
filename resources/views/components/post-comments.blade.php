<div class="post-comment">
    <div class="rate-holder reviews-holder">
        <div class="heading">
            <h3>ثبت نظر </h3>
        </div>
        <div class="rate-inner">
            <div class="form-holder">
                <livewire:comment-form :post="$post"/>
            </div>
        </div>
    </div>

    <livewire:comments-list :post="$post"/>
</div>
