 <div class="row">
     <div class="col-lg-5 col-md-5 col-sm-12">
         <div class="footer__box">
             <a class="footer__box__logo" href="{{ route('home') }}">
                 <img class="img-fluid" src="{{ asset('assets/logo/logo.png') }}" alt="{{ setting('app.name') }}">
             </a>
             <div class="footer__box__info">
                 <p class="footer__box__info__text">{{ setting('footer.info', '') }}</p>
                 <x-social-media></x-social-media>
             </div>
         </div>
     </div>
     <div class="col-lg-3 col-md-3 col-sm-12">
         <div class="footer__box">
             <h4 class="footer__box__title">
                 {{ setting('footer.mainMenuTitle', 'ارزکو') }}
             </h4>
             <div class="footer__box__links">
                 {{ menu(config('menus.site.footer')) }}
             </div>
         </div>
     </div>
     <div class="col-lg-4 col-md-4 col-sm-12">
         <div class="footer__box">
             <h4 class="footer__box__title">
                 عضویت در خبرنامه
             </h4>
             <div class="footer__box__newsletter">
                 <livewire:newsletter-form />
                 <p class="footer__box__newsletter__text">
                     با خبرنامه ما از جدیدترین اتفاقات ارزهای دیجیتال با خبر شوید و به روز باشید .
                 </p>
             </div>
         </div>
     </div>
 </div>
 <div class="row">
     <div class="col-lg-6 col-md-6 col-sm-12">
         <div class="bottom-footer__right">
             <p>{{ setting(
    'footer.copyright',
    '@کلیه حقوق این سایت متعلق به (فروشگاه.....) می‌باشد و هرگونه کپی برداری پیگرد قانونی
                دارد .',
) }}
             </p>
         </div>
     </div>
     <div class="col-lg-6 col-md-6 col-sm-12">
         <div class="bottom-footer__left">
             <a href="{{ url('terms-and-rules') }}" target="_blank"> شرایط و ضوابط</a>
             <a href="{{ url('privacy') }}" target="_blank">حریم خصوصی</a>
         </div>
     </div>
 </div>
