@push('add_styles')
    <link rel="stylesheet" href="{{ asset('css/tools.css') }}">
@endpush

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12">
        <aside class="filter-aside">
            <div class="navbar-filter box-cmp">
                <span class="navbar-filter__text">فیلترها</span>
                <i class="fas fa-search-dollar"></i>
            </div>
            <div class="filter-aside__box box-cmp">
                <h5 class="title-filter">بر اساس مبلغ مورد نظر</h5>
                <div class="filter-aside__box__item">
                    <div class="count">
                        <input class="count__input" type="number" placeholder="واحد پول : تومان">
                        <button class="clickable"><i class="fas fa-coins"></i></button>
                    </div>
                </div>
            </div>
            <div class="filter-aside__box box-cmp">
                <h5 class="title-filter"> ویژگی ها </h5>

                @foreach ($features as $key => $feature)
                    <div class="filter-aside__box__item">
                        <label class="label-filter">
                            <input class="filter" wire:click="filterFeatures('{{ $key }}')" @if (in_array($key, explode('@', $filter))) checked @endif
                                type="checkbox">
                            <span class="slider-filter"></span>
                        </label>
                        <span class="name-item"> {{ $feature }}
                        </span>
                    </div>
                @endforeach {{-- <div class="filter-aside__box__item">
                    <label class="label-filter">
                        <input class="filter" type="checkbox">
                        <span class="slider-filter"></span>
                    </label>
                    <span class="name-item"> احراز هویت </span>
                </div>
                <div class="filter-aside__box__item">
                    <label class="label-filter">
                        <input class="filter" type="checkbox">
                        <span class="slider-filter"></span>
                    </label>
                    <span class="name-item"> برنامه های وابسته </span>
                </div>
                <div class="filter-aside__box__item">
                    <label class="label-filter">
                        <input class="filter" type="checkbox">
                        <span class="slider-filter"></span>
                    </label>
                    <span class="name-item"> حساب کسب و کار </span>
                </div>
                <div class="filter-aside__box__item">
                    <label class="label-filter">
                        <input class="filter" type="checkbox">
                        <span class="slider-filter"></span>
                    </label>
                    <span class="name-item"> اپلیکشن موبایل </span>
                </div>
                <div class="filter-aside__box__item">
                    <label class="label-filter">
                        <input class="filter" type="checkbox">
                        <span class="slider-filter"></span>
                    </label>
                    <span class="name-item"> سردخانه </span>
                </div> --}}
            </div>
        </aside>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-12">
        <div class="content-aside">
            <div wire:loading.block>
                <div class="ph-item">
                    <div class="ph-col-12">
                        <div class="ph-picture"></div>
                        <div class="ph-row">
                            <div class="ph-col-6 big"></div>
                            <div class="ph-col-4 empty big"></div>
                            <div class="ph-col-2 big"></div>
                            <div class="ph-col-4"></div>
                            <div class="ph-col-8 empty"></div>
                            <div class="ph-col-6"></div>
                            <div class="ph-col-6 empty"></div>
                            <div class="ph-col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-aside__inner" wire:loading.remove>
                @if ($exchanges->total() > 0)
                    @foreach ($exchanges as $exchange)
                        <x-exchange-box :isBuy="$isBuy" :crypto="$crypto" :exchange="$exchange"></x-exchange-box>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        هیچ صرافی بر اساس فیلتر های شما وجود ندارد.
                    </div>
                @endif

                {{ $exchanges->links() }}
            </div>

        </div>
    </div>
</div>
