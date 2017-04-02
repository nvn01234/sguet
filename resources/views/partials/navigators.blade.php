<style>
    .page-header.navbar .page-logo {
        width: @if(Auth::check()) 15% @else 30% @endif;
    }

    @if (Auth::check())
        @media (max-width: 1194px) {
            .page-header.navbar .page-logo {
                width: 10%;
            }
        }

        @media (max-width: 1127px) {
            .page-header.navbar .page-logo {
                width: auto;
            }
        }

        @media (max-width: 1084px) {
            .hor-menu {
                display: none;
            }

            .page-header.navbar .menu-toggler.responsive-toggler {
                display: inline-block;
            }
        }
    @endif
</style>
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
<li class="@yield('menu.contacts')">
    <a href="{!! URL::route('contact.index') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Danh bạ
        <span class="@hasSection('menu.contacts') selected @endif"> </span>
    </a>
</li>
<li class="@yield('menu.about') @if(Auth::guest()) last @endif">
    <a href="{!! URL::route('about') !!}" data-hover="megamenu-dropdown" data-close-other="true">
        Giới thiệu
        <span class="@hasSection('menu.about') selected @endif"> </span>
    </a>
</li>
@if(Auth::check())
    <li class="classic-menu-dropdown @yield('menu.manage') dropdown-dark">
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
            <li class="@yield('menu.manage.contact')">
                <a href="{!! route('manage.contact') !!}">
                    Danh bạ
                </a>
            </li>
        </ul>
    </li>
    <li class="classic-menu-dropdown @yield('menu.statistics') dropdown-dark last">
        <a href="javascript:" data-hover="megamenu-dropdown" data-close-other="true">
            Thống kê
            <i class="fa fa-angle-down"></i>
            <span class="@hasSection('menu.statistics') selected @endif"> </span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li class="@yield('menu.statistics.tag')">
                <a href="{!! route('statistics.tag') !!}">
                    Nhãn
                </a>
            </li>
            <li class="@yield('menu.statistics.search_log')">
                <a href="{!! route('statistics.search_log') !!}">
                    Lịch sử tìm kiếm
                </a>
            </li>
        </ul>
    </li>
@endif