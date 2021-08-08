<div class="stars">
    @for ($i = 1; $i <= 5; $i++)
        <i class="fa fa-star @if ($total>= $i) star-yellow @endif"></i>
    @endfor
</div>
