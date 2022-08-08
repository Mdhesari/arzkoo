<section class="exchanges py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="title-section">
                    مقایسه بیشتر از {{ $exchanges->count() }} صرافی ارزهای دیجیتال
                </h2>
            </div>
        </div>
        <div class="row exchange-holder">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($exchanges as $exchange)
                        <div class="swiper-slide">
                            <div class="inner-slider">
                                <a href="{{ route('exchanges.show', $exchange) }}">
                                    <img src="{{ $exchange->logo_url }}" alt="{{ $exchange->title }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

@push('add_styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}"> --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

@endpush

@push('add_scripts')
    {{-- <script defer src="{{ asset('js/swiper-bundle.min.js') }}"></script> --}}
    <script>
        $(function() {
            // SWIPER
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 4,
                spaceBetween: 30,
                // centeredSlides: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    // when window width is <= 768px
                    992: {
                        slidesPerView: 5,
                        spaceBetweenSlides: 20
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    },
                    100: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 50
                    }
                    // when window width is <= 999px
                },
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
            });
            // SWIPER
        })
    </script>
@endpush
