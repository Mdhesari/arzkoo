@extends('layouts.app')

@section('content')
    <section class="register py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="register__form">
                        <form id="main_form" action="{{ route('dashboard.confirm-mobile') }}" method="POST">
                            @csrf
                            <div class="holder-header-otp">
                                <img class="img-fluid" src="{{ url('assets/img/message.png') }}" alt="Login Vector">
                                <h2> تایید شماره موبایل</h2>
                            </div>
                            <div class="form-enter-code" id="form_confirm_code">
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل</label>
                                    <input disabled class="form-control" type="tel" id="mobile" name="mobile"
                                        value="{{ $mobile }}">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="code" class="form-control" id="passwordcode"
                                        placeholder="کد 6 رقمی">
                                    <label for="passwordcode">
                                        لطفا کد 6 رقمی ارسال شده را وارد نمایید
                                        .
                                    </label>
                                </div>
                                @error('code')
                                    <p class="alert alert-danger">{{ $message }}</p>
                                @enderror
                                <button class="clickable" id="do_get_register-code" type="submit">ورود</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('add_scripts')
    <script>
        window.onload = () => {

            document.getElementById('resend_btn').addEventListener('click', (e) => {
                e.preventDefault();
                document.getElementById('resend-form').submit()
            })

            const resendSeconds = document.getElementById('seconds_to_resend'),
                resendSecondsWrapper = document.getElementById('seconds_wrapper'),
                countdownInterval = setInterval(() => {
                    let seconds = Number(resendSeconds.textContent)

                    if (seconds <= 0) {
                        resendSecondsWrapper.classList.add('d-none')
                        clearInterval(countdownInterval)
                        return;
                    }

                    resendSeconds.textContent = (seconds - 1)
                }, 1000);
        }
    </script>
@endpush
