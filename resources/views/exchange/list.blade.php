@extends('layouts.app')

@section('content')
    <x-searchly :showMetaData="false" className="box-bottom-header py-5"></x-searchly>
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
                            <div class="filters-main__card featured-box box-cmp" data-label="پیشنهاد سایت">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="header-right">
                                            <div class="images">
                                                <img src="./assets/img/xcoins.png" alt="">
                                            </div>
                                            <div class="star">
                                                <i class="fa fa-star star-yellow"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="info-star">
                                                <span>1</span>
                                                امتیاز از
                                                <span>5</span>
                                                امتیاز
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="header-left">
                                            <div class="price">36,581.80 تومان</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="b-header-right">
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="b-header-left">
                                            <div class="b-header-left__inner">
                                                <p>
                                                    Price for <span>1 VET</span>
                                                </p>
                                                <p>
                                                    Usually <strong>+117,498.6%</strong> more
                                                <p>than best price</p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="body-right">
                                            <p class="info-exchanges">لورم ایپسوم متن ساختگی با تولید
                                                سادگی نامفهوم از صنعت
                                                چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                                                است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای
                                                متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="body-left text-center">
                                            <a class="link-site clickable" href="#">
                                                برو تو سایت
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="footer-right text-right">
                                            <i class="fas fa-shield-check" data-toggle="tooltip" data-placement="top"
                                                title=" 1 نمایش پیشفرض"></i>
                                            <i class="fa fa-temperature-frigid" data-toggle="tooltip" data-placement="top"
                                                title=" 2 نمایش پیشفرض"></i>
                                            <i class="fa fa-link" data-toggle="tooltip" data-placement="top"
                                                title=" 3 نمایش پیشفرض"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filters-main__card feature box-cmp">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="header-right">
                                            <div class="images">
                                                <img src="./assets/img/xcoins.png" alt="">
                                            </div>
                                            <div class="star">
                                                <i class="fa fa-star star-yellow"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="info-star">
                                                <span>1</span>
                                                امتیاز از
                                                <span>5</span>
                                                امتیاز
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="header-left">
                                            <div class="price">36,581.80 تومان</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="b-header-right">
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                            <div class="b-header-right__item">
                                                <div class="title">پشتیبانی</div>
                                                <div class="info">24 ساعته</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="b-header-left">
                                            <div class="b-header-left__inner">
                                                <p>
                                                    Price for <span>1 VET</span>
                                                </p>
                                                <p>
                                                    Usually <strong>+117,498.6%</strong> more
                                                <p>than best price</p>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <div class="body-right">
                                            <p class="info-exchanges">لورم ایپسوم متن ساختگی با تولید
                                                سادگی نامفهوم از صنعت
                                                چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم
                                                است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای
                                                متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="body-left text-center">
                                            <a class="link-site clickable" href="#">
                                                برو تو سایت
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="footer-right text-right">
                                            <i class="fas fa-shield-check" data-toggle="tooltip" data-placement="top"
                                                title=" 1 نمایش پیشفرض"></i>
                                            <i class="fa fa-temperature-frigid" data-toggle="tooltip" data-placement="top"
                                                title=" 2 نمایش پیشفرض"></i>
                                            <i class="fa fa-link" data-toggle="tooltip" data-placement="top"
                                                title=" 3 نمایش پیشفرض"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
