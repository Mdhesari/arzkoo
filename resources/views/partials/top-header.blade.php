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
        <a href="#">
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
