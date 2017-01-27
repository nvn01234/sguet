@php
    $navigators = [
        ['name' => 'Q&A', 'route' => 'home'],
        ['name' => 'Tin tức - Hoạt động', 'route' => 'news'],
        ['name' => 'Giới thiệu', 'route' => 'about']
    ]
@endphp
@foreach($navigators as $nav)
    @include('partials.classic_navigator', $nav)
@endforeach
@if(Auth::check())
    <li class="@hasSection('mobile') nav-item @endif @yield('menu.admin') classic-menu-dropdown">
        <a href="javascript:" class="@hasSection('mobile') nav-link nav-toggle @endif" data-hover="megamenu-dropdown"
           data-close-other="true">
            Quản trị
            <i class="fa fa-angle-down"></i>
            <span class="@hasSection('menu.admin') selected @endif"> </span>
        </a>
        <ul class="dropdown-menu pull-left">
            <li>
                <a href="javascript:">
                    <i class="fa fa-question"></i>
                    Q&A
                </a>
            </li>
        </ul>
    </li>
@endif