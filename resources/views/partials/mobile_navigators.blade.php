<li class="nav-item @yield('menu.home')">
    <a href="{!! URL::route('home') !!}" class="nav-link nav-toggle">
        Q&A
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
            <li class="nav-item @yield('menu.manage.faq')">
                <a href="{!! URL::route('manage.faq') !!}" class="nav-link">
                    <i class="fa fa-question"></i>
                    Q&A
                </a>
            </li>
            <li class="nav-item @yield('menu.manage.article')">
                <a href="{!! URL::route('manage.article') !!}" class="nav-link">
                    <i class="fa fa-newspaper-o"></i>
                    Tin tức - Hoạt động
                </a>
            </li>
        </ul>
    </li>
@endif