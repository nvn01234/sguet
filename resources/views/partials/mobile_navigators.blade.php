<li class="nav-item @yield('menu.home')">
    <a href="{!! URL::route('home') !!}" class="nav-link nav-toggle">
        UET Q&A
    </a>
</li>
<li class="nav-item @yield('menu.articles')">
    <a href="{!! URL::route('articles') !!}" class="nav-link nav-toggle">
        Tin tức - Hoạt động
    </a>
</li>
<li class="nav-item @yield('menu.about')">
    <a href="{!! URL::route('about') !!}" class="nav-link nav-toggle">
        Giới thiệu
    </a>
</li>
@if(Auth::check())
    <li class="nav-item @yield('menu.manage') @hasSection('menu.manage') open @endif">
        <a href="javascript:" class="nav-link nav-toggle">
            Quản lý
            <span class="arrow @hasSection('menu.manage') open @endif"></span>
        </a>
        <ul class="sub-menu">
            @role('admin')
            <li class="nav-item @yield('menu.manage.user')">
                <a href="{!! route('manage.user') !!}" class="nav-link">
                    Người dùng
                </a>
            </li>
            @endrole
            <li class="nav-item @yield('menu.manage.faq')">
                <a href="{!! route('manage.faq') !!}" class="nav-link">
                    UET Q&A
                </a>
            </li>
            <li class="nav-item @yield('menu.manage.article')">
                <a href="{!! route('manage.article') !!}" class="nav-link">
                    Tin tức - Hoạt động
                </a>
            </li>
        </ul>
    </li>
@endif