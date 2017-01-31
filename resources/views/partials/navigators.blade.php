<li class="@yield('menu.home')">
    <a href="{!! URL::route('home') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Q&A
        <span class="@hasSection('menu.home') selected @endif"> </span>
    </a>
</li>
<li class="@yield('menu.articles')">
    <a href="{!! URL::route('articles') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Tin tức - Hoạt động
        <span class="@hasSection('menu.articles') selected @endif"> </span>
    </a>
</li>
<li class="@yield('menu.about')">
    <a href="{!! URL::route('about') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Giới thiệu
        <span class="@hasSection('menu.about') selected @endif"> </span>
    </a>
</li>
@if(Auth::check())
    <li class="classic-menu-dropdown @yield('menu.manage')">
        <a href="javascript:" data-hover="megamenu-dropdown" data-close-other="true">
            Quản lý
            <i class="fa fa-angle-down"></i>
            <span class="@hasSection('menu.manage') selected @endif"> </span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class="@yield('menu.manage.faq')">
                <a href="{!! URL::route('manage.faq') !!}">
                    <i class="fa fa-question"></i>
                    Q&A
                </a>
            </li>
        </ul>
    </li>
@endif