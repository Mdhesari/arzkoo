@extends('layouts.app')

@section('content')
    <section class="account-section py-5">
        <div class="container">
            <div class="row">
                @include('partials.dashboard-sidebar')

                <div class="col-lg-9 col-md-12 account-content-holder">
                    <div class="account-content-inner">
                        <div class="header">
                            <span>
                                حذف حساب کاربری
                            </span>
                        </div>
                        <div class="body">
                            <form action="{{ route('dashboard.delete-account') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="alert alert-warning">
                                    این عملکرد قابل بازگشت نیست. با این کار حساب شما و همه موارد مرتبط برای همیشه حذف می شود
                                </div>
                                <div class="form-group">
                                    <label for="password">رمز عبور کنونی</label>
                                    <input name="password" type="password" id="password">
                                </div>
                                <div class="form-group btn-holder">
                                    <button type="submit" class="btn btn-primery">حذف</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
