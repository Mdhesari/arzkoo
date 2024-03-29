<div class="top-header">
    <div class="right-header">
        <button class="burger-btn" id="burgerBtn" onclick="openMenu()">
            <i class="fas fa-bars"></i>
        </button>
        <x-arzkoo-logo></x-arzkoo-logo>
        <nav class="main-menu" id="mainMenu">
            <h2 class="d-none">منوی کاربری ارزکو</h2>
            {{ menu(config('menus.site.main')) }}
        </nav>
    </div>
    <div class="actions">
        @auth
            <a class="profile-btn" href="{{ route('dashboard.home') }}">
                <span>پنل کاربری</span>
                <i class="far fa-long-arrow-alt-left"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-danger">خروج از حساب</button>
            </form>
            <div class="dropdown" id="profile-dropdown">
                <ul>
                    <li><a class="clickable" href="#">پروفایل من</a></li>
                    <li><a class="clickable" href="#">سفارش های من</a></li>
                    <li><a class="clickable" href="#">خبرنامه</a></li>
                    <li><a class="clickable" href="#">خروج</a></li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}">
                ثبت نام
            </a>
        @endauth
    </div>
</div>

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
