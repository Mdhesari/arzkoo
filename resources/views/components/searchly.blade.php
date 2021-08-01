<section class="{{ $className }}">
    <div class="container">

        @if ($showMetaData)
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title-section m-30">
                        بهترین مکان را برای خرید ارز دیجیتال پیدا کن
                    </h1>
                </div>
            </div>
        @endif

        <div class="row search-holder">
            <div class="search-item col-md-4 col-xs-12">
                <div class="switch-toggle">
                    <a href="#" class="toggle clickable active" data-type="buy">خرید</a>
                    <a href="#" class="toggle clickable" data-type="sell">فروش</a>
                </div>
            </div>
            <div class="search-item col-md-5 col-xs-12">
                <select id="currencies" name="currency">
                    @foreach ($cryptos as $crypto)
                        <option value="{{ $crypto->name }}" @if ($loop->first) selected @endif>{{ $crypto->name }}</option>
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

        @if ($showMetaData)
            <div class="row recommendations">
                <div class="recommendations-title text-center ">
                    <h2 class="mt-5">ارزکو در آخرین لحظه {{ $totalCryptos }} نرخ ارز را برای شما بررسی کرده است</h2>
                </div>
                <div class="live-prices m-30">
                    <div class="item">
                        <div class="icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="detail">
                            <strong>800 میلیون</strong>
                            <p>بهترین قیمت بیتکون در کریپتو</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="detail">
                            <strong>800 میلیون</strong>
                            <p>بهترین قیمت بیتکون در کریپتو</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="detail">
                            <strong>800 میلیون</strong>
                            <p>بهترین قیمت بیتکون در کریپتو</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="detail">
                            <strong>800 میلیون</strong>
                            <p>بهترین قیمت بیتکون در کریپتو</p>
                        </div>
                    </div>
                    <div class="item">
                        <div class="icon">
                            <i class="fab fa-btc"></i>
                        </div>
                        <div class="detail">
                            <strong>800 میلیون</strong>
                            <p>بهترین قیمت بیتکون در کریپتو</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

@push('add_styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {

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

            $("#currencies").select2({
                width: "100%",
                // templateResult: function(idioma) {
                //     console.log(idioma)
                //     var $span = $("<span><img src='https://www.free-country-flags.com/countries/" +
                //         idioma.id + "/1/tiny/" + idioma.id + ".png'/> " + idioma.text + "</span>");
                //     return $span;
                // },
                // templateSelection: function(idioma) {
                //     var $span = $("<span><img src='https://www.free-country-flags.com/countries/" +
                //         idioma.id + "/1/tiny/" + idioma.id + ".png'/> " + idioma.text + "</span>");
                //     return $span;
                // },
                ajax: {
                    url: '{{ route('currencies') }}',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    dataType: 'json',
                    processResults: function(data) {
                        // Transforms the top-level key of the response object from 'items' to 'results'
                        return {
                            results: data.data
                        };
                    }
                },
            });
        })
    </script>
@endpush
