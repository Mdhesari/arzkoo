<aside class="col-lg-3 col-md-12 sidebar">
    <div class="sidebar-inner">
        <ul class="sidebar-items">
            <li class="sidebar-item @if (is_route('dashboard.home')) active @endif">
                <a href="{{ route('dashboard.home') }}">
                    حساب کاربری
                </a>
            </li>
            <li class="sidebar-item @if (is_route('dashboard.delete-account')) active @endif">
                <a href="{{ route('dashboard.delete-account') }}">
                    حذف حساب کاربری
                </a>
            </li>
        </ul>
    </div>
</aside>
