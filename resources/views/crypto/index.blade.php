@extends('layouts.app')

@section('content')
    <section class="live-prices py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="title-section m-30">
                        قیمت لحظه ای ارزهای دیجیتال را مشاهده کنید
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="responsive-iframe">
                        <iframe src="https://coin360.com" frameborder="0" title="Coin360.com: Cryptocurrency Market State"
                            width="100%" height="800" id="myIframe"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection