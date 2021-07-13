@extends('layouts.app')

@section('content')
    <section class="register py-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="register__form">
                        <form id="main_form" action="">
                            <div class="holder-header-otp">
                                <img class="img-fluid" src="{{ url('assets/img/message.png') }}" alt="Login Vector">
                                <h2> خرید و فروش شما با امن ترین راه انجام خواهد شد .</h2>
                            </div>
                            <div class="inner-form">
                                <div class="form-enter-number">
                                    <div class="form-group">
                                        <input name="username" type="number" class="form-control" id="phonenumber"
                                            placeholder="0912*******">
                                        <label for="phonenumber"> لطفا شماره همراه خود را وارد نمایید .</label>
                                    </div>
                                    <button class="clickable" id="do_register" type="button">ارسال کد
                                        تایید</button>

                                </div>
                                <div class="form-enter-code close__form-otp" id="form_confirm_code">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="passwordcode" placeholder="کد 6 رقمی">
                                        <label for="passwordcode"> لطفا کد 6 رقمی ارسال شده را وارد نمایید
                                            .</label>
                                    </div>
                                    <button class="clickable" id="do_get_register-code" type="button">ورود</button>
                                    <div class="form-enter-code__link">
                                        <a class="clickable" id="resend_btn">ارسال مجدد کد تا
                                            <span id="seconds_to_resend"></span>
                                            ثانیه دیگر
                                        </a>
                                        <a class="clickable editnumber">تغییر شماره همراه</a>
                                    </div>
                                </div>
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
        // FORM OTP
        window.onload = () => {

            class Otp {
                constructor() {
                    this.initElements()
                    this.goTo('pending')
                }

                initElements() {
                    const elements = {
                        'sendBtn': '#do_register',
                        'editBtn': '.editnumber',
                        'enterNumber': '.form-enter-number',
                        'enterCode': '.form-enter-code',
                        'phoneNumber': '#phonenumber',
                        'loginBtn': '#do_get_register-code',
                        'passwordcode': '#passwordcode',
                        'confirmForm': '#form_confirm_code',
                        'resendSeconds': '#seconds_to_resend',
                        'resendBtn': '#resend_btn',
                        'mainForm': '#main_form .inner-form'
                    }

                    Object.keys(elements).forEach(key => {
                        const target = document.querySelector(elements[key])

                        if (!target) {
                            throw Error(`Element ${elements[key]} not found!`)
                        }

                        this[key] = document.querySelector(elements[key])
                    })
                }

                goTo(status) {
                    switch (status) {
                        case 'pending':
                            this.goToGetPhoneNumber()
                            break;
                        case 'verification':
                            this.goToVerificationCode()
                            break
                        case 'error':
                            this.goToError()
                            break
                        case 'back_to_pending':
                            this.backToGetPhoneNumber()
                            break;
                        default:
                            break;
                    }
                }


                goToGetPhoneNumber() {
                    const registerEventUnsubsciber = this.sendBtn.addEventListener('click', event => {
                        event.preventDefault()
                        if (this.isPhoneNumberFormatValid(this.phoneNumber.value)) {

                            axios.post('{{ route('login') }}', {
                                username: this.phoneNumber.value
                            }).then(res => {
                                removeEventListener('click', registerEventUnsubsciber)
                                this.resendSeconds.textContent = res.data.resend
                                this.goTo('verification')
                            }).catch(err => {
                                this.goTo('error')
                            })
                        } else {
                            this.goTo('error')
                        }
                    })
                }

                isPhoneNumberFormatValid(phoneNumber) {
                    const regexNumber = /^[0-9]{11}$/;
                    return phoneNumber.match(regexNumber)
                }

                goToError() {
                    this.phoneNumber.style.border = "1px solid red";
                    this.phoneNumber.value = "";
                    this.phoneNumber.placeholder = 'شماره همراه وارد شده نامعتبر میباشد';
                }

                goToVerificationCode() {
                    const goBackUnsubsciber = this.editBtn.addEventListener('click', (event) => {
                        this.goTo('back_to_pending')
                        removeEventListener('click', goBackUnsubsciber)
                    })
                    this.enterNumber.classList.add("close__form-otp")
                    setTimeout(() => {
                        this.enterCode.classList.remove("close__form-otp");
                        this.enterCode.classList.add("open__form-otp");
                    }, 500)

                    this.resendBtn.addEventListener('click', (event) => {
                        event.preventDefault()
                        this.clearAllVerificationErrors()
                        this.goToGetPhoneNumber()
                    })

                    this.loginBtn.addEventListener('click', (event) => {
                        event.preventDefault()
                        this.clearAllVerificationErrors()
                        this.sendLoginRequest()
                    })
                }

                sendLoginRequest() {
                    axios.put('{{ route('login') }}', {
                        username: this.phoneNumber.value,
                        code: this.passwordcode.value
                    }).then(res => {
                        res = res.data
                        if (res.status) {
                            window.location = res.redirect
                        }
                    }).catch(err => {
                        const {
                            errors
                        } = err.response.data
                        for (let error in errors) {
                            for (err of errors[error]) {
                                this.addErrorToForm(err)
                            }
                        }
                    })
                }

                addErrorToForm(err) {
                    this.mainForm.innerHTML = `
                    <div class="alert alert-danger">${err}</div>
                    ` + this.mainForm.innerHTML
                }

                clearAllVerificationErrors() {
                    let errorEls = this.mainForm.querySelectorAll('.alert-danger')

                    while (errorEls.length > 0) {
                        errorEls[0].parentNode.removeChild(errorEls[0])
                    }
                }

                backToGetPhoneNumber() {
                    this.enterCode.classList.remove("open__form-otp")
                    this.enterCode.classList.add("close__form-otp")
                    setTimeout(() => {
                        this.enterNumber.classList.remove("close__form-otp");
                    }, 500)
                }
            }

            new Otp();
        }
    </script>
@endpush
