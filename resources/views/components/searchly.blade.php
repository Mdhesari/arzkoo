<section class="{{ $className }}">
    <div class="container">

        @if ($showMetaData)
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title-section m-30">
                        با <strong>ارزکو</strong> ارزون بخر، گرون بفروش
                    </h1>
                </div>
            </div>
        @else
            <div class="mb-4 text-center">
                <h1 class="h2 text-white">
                    {{ ($isBuy ? ' فروش ':' خرید ') . $crypto->full_name }}
                </h1>
            </div>
        @endif

        <div class="row search-holder">
            <div class="search-item col-md-4 col-xs-12">
                <div class="switch-toggle">
                    <a href="#" class="toggle clickable @if ($isBuy) active @endif" data-type="buy">خرید از شما</a>
                    <a href="#" class="toggle clickable @if (!$isBuy) active @endif" data-type="sell"> فروش به شما</a>
                </div>
            </div>
            <div class="search-item col-md-5 col-xs-12">
                <select id="currencies" name="currency">
                    @foreach ($cryptos as $cry)
                        <option data-logo="{{ $cry->logo_full_url }}" value="{{ $cry->full_name }}"
                                @if ($crypto && $crypto->id == $cry->id) selected
                                @elseif($loop->first) selected @endif>{{ $cry->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="search-item col-md-3 col-xs-12">
                <a class="btn btn-search btn-primary btn-lg btn-block" id="search-btn">
                    <span>
                        جستجو
                        <i aria-hidden="true" class="fa fa-search"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if ($showMetaData)
            <div class="row recommendations">
                <div class="recommendations-title text-center ">
                    <h2 class="mt-5">ارزکو در آخرین لحظه {{ $totalCryptos }} نرخ ارز را برای شما بررسی کرده است</h2>
                </div>
                <div class="swiper live-prices live-prices-slider row m-30">
                    <div class="swiper-wrapper">
                        @php $countBestEx = 0 @endphp
                        @foreach ($favCryptos as $cry)
                            @php $best = $cry->bestBuyExchange->first() @endphp

                            @if ($best)
                                <div class="swiper-slide">
                                    <div class="item">
                                        <div class="icon">
                                            <img src="{{ $cry->logo_full_url }}" alt="{{ $cry->name }}">
                                        </div>
                                        <div class="detail">
                                            <strong>{{ $best->irr_buy_price_formatted }}</strong>
                                            <p>بهترین قیمت {{ $cry->name }} در {{ $best->persian_title }}</p>
                                        </div>
                                        @php ++$countBestEx @endphp
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('add_styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single {
            height: 50px;
            text-align: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 50px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 50%;
            right: initial;
            left: 1%;
            transform: translateY(-50%);
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b .select2-container--default .select2-selection--single .select2-selection__arrow b.select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-width: 6px 5px 1px 5px;
        }

    </style>
@endpush

@push('add_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function getSelectItem(data) {
            return '<span">' + data.text + '<img class="select2-logo" src="' + data.logo + '" /> ' + '</span>';
        }

        $(function () {

            const toggles = Array.from(document.querySelectorAll('.switch-toggle .toggle')),
                searchBtn = document.getElementById('search-btn')

            searchBtn.addEventListener('click', (e) => {
                const type = document.querySelector('.switch-toggle .toggle.active').dataset.type,
                    currency = $("#currencies").val().toLowerCase();
                let url = ""

                switch (type) {
                    case 'buy':
                        url = '{{ route('exchanges.buy-list') }}' + currency
                        break;
                    default:
                        url = '{{ route('exchanges.sell-list') }}' + currency
                }

                window.location = url
            })

            toggles.map(item => {
                item.addEventListener('click', (e) => {
                    document.querySelector('.switch-toggle .toggle.active').classList.remove(
                        'active')
                    e.target.classList.add('active')
                })
            })

            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }
                var baseUrl = "/user/pages/images/flags";
                var $state = $(
                    '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() +
                    '.png" class="img-flag" /> ' +
                    state.text + '</span>'
                );
                return $state;
            };

            $('#currencies').select2({
                width: "100%",
                templateResult: function (data, el) {
                    if (!data.logo) return
                    return $('<span">' + data.text + '<img class="select2-logo" src="' + data.logo + '" /> ' + '</span>');
                },
                templateSelection: function (data, el) {
                    let logo = data.logo ?? data.element.dataset.logo

                    return $('<span>' + data.text + '<img class="select2-logo" src="' + logo + '" /> ' + '</span>');
                },
                pagination: {
                    more: true
                },
                ajax: {
                    url: '{{ route('currencies') }}',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            page: params.page || 1,
                            type: 'public'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    dataType: 'json',
                    processResults: function (data, params) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.data,
                            pagination: {
                                more: data.meta.current_page < data.meta.last_page
                            }
                        };
                    }
                },
            });

            var swiper = new Swiper(".live-prices-slider", {
                slidesPerView: 5,
                spaceBetween: 30,
                freeMode: true,
                breakpoints: {
                    // when window width is <= 768px
                    992: {
                        slidesPerView: 5,
                        spaceBetweenSlides: 30
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    },
                    100: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 30
                    }
                    // when window width is <= 999px
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        })

    </script>
@endpush
