<div class="top-header">
    <div class="right-header">
        <button class="burger-btn" id="burgerBtn" onclick="openMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <div class="logo-holder">
            <a href="index.html">
                <img src="assets/img/logo.png" alt="">
            </a>
        </div>
        <nav class="main-menu" id="mainMenu">
            <h2 class="d-none">منوی کاربری ارزکو</h2>
            {{ menu('main') }}
            <!-- <ul>
                <li><a href="filter-page.html" class="active">مقایسه قیمت</a></li>
                <li><a href="exchanges.html">صرافی ها </a></li>
                <li><a href="blog.html">بلاگ </a></li>
                <li><a href="live-prices.html">قیمت لحظه ای</a></li>
            </ul> -->
        </nav>
    </div>
    <div class="actions">
        <a href="otp.html">
            ثبت نام
        </a>
    </div>
</div>

@push('add_scripts')
    <script>
        function openMenu() {

            document.getElementById('mainMenu').classList.add('active-menu');
            document.getElementById('darkLayer').classList.add('active');
        }

        function closeMenu() {
            document.getElementById('mainMenu').classList.remove('active-menu');
            document.getElementById('darkLayer').classList.remove('active');
        }

    </script>
@endpush
