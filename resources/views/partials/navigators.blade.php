<li class="@yield('menu.home')">
    <a href="{!! URL::route('home') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        UET Q&A
        <span class="@hasSection('menu.home') selected @endif"> </span>
    </a>
</li>
<li class="@yield('menu.articles')">
    <a href="{!! URL::route('articles') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Tin tức - Hoạt động
        <span class="@hasSection('menu.articles') selected @endif"> </span>
    </a>
</li>
<li class="@yield('menu.about') @if(Auth::guest()) last @endif">
    <a href="{!! URL::route('about') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Giới thiệu
        <span class="@hasSection('menu.about') selected @endif"> </span>
    </a>
</li>
@if(Auth::check())
    <li class="classic-menu-dropdown @yield('menu.manage') dropdown-dark last">
        <a href="javascript:" data-hover="megamenu-dropdown" data-close-other="true">
            Quản lý
            <i class="fa fa-angle-down"></i>
            <span class="@hasSection('menu.manage') selected @endif"> </span>
        </a>
        <ul class="dropdown-menu pull-left">
            @role('admin')
            <li class="@yield('menu.manage.user')">
                <a href="{!! route('manage.user') !!}">
                    Người dùng
                </a>
            </li>
            @endrole
            <li class="@yield('menu.manage.faq')">
                <a href="{!! route('manage.faq') !!}">
                    UET Q&A
                </a>
            </li>
            <li class="@yield('menu.manage.article')">
                <a href="{!! route('manage.article') !!}">
                    Tin tức - Hoạt động
                </a>
            </li>
            <li class="@yield('menu.manage.tag')">
                <a href="{!! route('manage.tag') !!}">
                    Nhãn
                </a>
            </li>
        </ul>
    </li>
@endif