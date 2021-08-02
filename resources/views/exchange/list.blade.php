@extends('layouts.app')

@section('content')
    <x-searchly :isBuy="$isBuy" :showMetaData="false" className="box-bottom-header py-5" :crypto="$crypto"></x-searchly>
    <section class="filters-main py-4">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title-section py-2">
                        عبارت مورد نظر رو بر اساس فیلترها پیدا کنید
                    </h1>
                </div>
            </div> --}}
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
                            <div class="filter-aside__box__item">
                                <label class="label-filter">
                                    <input class="filter" type="checkbox">
                                    <span class="slider-filter"></span>
                                </label>
                                <span class="name-item"> بلاگ </span>
                            </div>
                            <div class="filter-aside__box__item">
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
                            </div>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <div class="content-aside">
                        <div class="content-aside__inner">
                            @foreach ($exchanges as $exchange)
                                <x-exchange-box :isBuy="$isBuy" :crypto="$crypto" :exchange="$exchange"></x-exchange-box>
                            @endforeach
                        </div>

                        {{ $exchanges->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('add_scripts')
    <script>
        window.onload = () => {
            const filters = Array.from(document.querySelectorAll('.slider-filter'))

            filters.map((filter) => {
                filter.addEventListener('click', (e) => {
                    // alert('hi')
                })
            })
        }
    </script>
@endpush
