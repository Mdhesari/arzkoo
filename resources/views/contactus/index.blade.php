@extends('layouts.app')

@section('content')
    <section class="about-us-section contact-us py-5">
        <div class="container">
            <div class="about-us-header contact-us-header text-center">

                <div class="about-us-title contact-us-title">
                    <h1>
                        تماس با ما (ارزکو)
                    </h1>
                </div>
            </div>
            <div class="post-inner">
                <div class=" row informations">
                    <div class="col-md-4 col-xs-12 information">
                        <a href="">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fas fa-map-marker"></i>
                                </div>
                                <div class="info">
                                   ایران - تهران
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xs-12 information">
                        <a href="mailto:info@azkoo.com">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fas fa-envelope-open"></i>
                                </div>
                                <div class="info">
                                    info@azkoo.com
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-xs-12 information">
                        <a href="tel:021 - به زودی">
                            <div class="inner">
                                <div class="icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info">
                                    021 - به زودی
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <livewire:contact-form />
            </div>
        </div>

    </section>
@endsection
