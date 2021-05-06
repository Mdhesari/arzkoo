@extends('layouts.app')

@section('content')
<div>
    <section class="about-us-section single-blog py-5">
        <div class="container">
            <x-single-blog :post="$post"></x-single-blog>
        </div>
    </section>
</div>
@endsection
