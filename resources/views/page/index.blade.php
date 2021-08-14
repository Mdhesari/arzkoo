@extends('layouts.app')

@section('content')
    <div>
        <section class="about-us-section single-blog py-5">
            <div class="container">
                <section class="about-us-section py-5">
                    <div class="container">
                        <div class="about-us-header text-center">
                            <div class="about-us-title">
                                <h1>
                                    {{ $page->title }}
                                </h1>
                            </div>
                        </div>
                        <div class="post-inner">
                            <div class="post-content">
                                <div class="image-holder"
                                    style="background-image: url('{{ \Storage::url($page->image) }}');">
                                </div>
                                {!! $page->body !!}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
