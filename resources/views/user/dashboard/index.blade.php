@extends('layouts.app')

@section('content')
    <section class="account-section py-5">
        <div class="container">
            <div class="row">
                <aside class="col-lg-3 col-md-12 sidebar">
                    <div class="sidebar-inner">
                        <ul class="sidebar-items">
                            <li class="sidebar-item active">
                                <a href="account.html">
                                    حساب کاربری
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="delete-account.html">
                                    حذف حساب کاربری
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
                <div class="col-lg-9 col-md-12 account-content-holder">
                    <div class="account-content-inner">
                        <div class="header">
                            <span>
                                بروزرسانی تصویر
                            </span>
                        </div>
                        <div class="body">
                            <form action="{{ route('dashboard.update-picture') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="image-holder" style="background-image: url('{{ url($user->fullImage) }}');">
                                </div>
                                <div class="form-group">
                                    <input type="file" accept="image/*" name="image" class="file">
                                    <div class="file-holder">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                        <span>انتخاب عکس</span>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <button class="btn btn-primery">بروزرسانی</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="account-content-inner">
                        <div class="header">
                            <span>
                                بروزرسانی نام
                            </span>
                        </div>
                        <div class="body">
                            <form action="{{ route('dashboard.update-name') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">نام</label>
                                    <input type="text" name="name" value="{{ $user->name }}">
                                </div>
                                @error('name')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group btn-holder">
                                    <button class="btn btn-primery">ذخیره</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="account-content-inner">
                        <div class="header">
                            <span>
                                تغییر شماره موبایل
                            </span>
                        </div>
                        <div class="body">
                            <form action="{{ route('dashboard.update-mobile') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل</label>
                                    <input type="tel" id="mobile" name="mobile" value="{{ $user->mobile }}">
                                </div>
                                @error('mobile')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label for="password">رمز عبور کنونی</label>
                                    <input type="password" id="password" name="password">
                                </div>
                                <div class="form-group btn-holder">
                                    <button class="btn btn-primery">تغییر</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="account-content-inner">
                        <div class="header">
                            <span>
                                تغییر رمز عبور
                            </span>
                        </div>
                        <div class="body">
                            <form action="{{ route('dashboard.update-password') }}" method="POST">
                                @csrf
                                @method('PUT')
                                @if ($user->hasPassword())
                                    <div class="form-group">
                                        <label for="current_password">رمز عبور کنونی</label>
                                        <input type="current_password" name="current_password" id="current_password">
                                    </div>
                                    @error('current_password')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                    @enderror
                                @endif
                                <div class="form-group">
                                    <label for="password">رمز عبور جدید</label>
                                    <input type="password" name="password" id="password">
                                </div>
                                @error('password')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group">
                                    <label for="password_confirm"> تایید رمز عبور جدید</label>
                                    <input type="password" name="password_confirmation" id="password_confirm">
                                </div>
                                <div class="form-group btn-holder">
                                    <button class="btn btn-primery">تغییر</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
