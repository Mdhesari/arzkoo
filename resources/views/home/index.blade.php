@extends('layouts.app')

@section('content')
<div>
    <section class="head-section">
        <div class="title-blog">
            <h1> بلاگ ارزکو</h1>
        </div>
        <div class="desc-blog">
            نکات و مطالبی که باید درمورد ارزهای رمزنگاری شده بدانیم
        </div>
    </section>
    <section class="blog-holder">
        <div class="container">
            <x-blog-list :posts="$posts"></x-blog-list>
        </div>
    </section>
</div>
@endsection
