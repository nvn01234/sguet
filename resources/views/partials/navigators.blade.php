@php
    $navigators = [
        ['type' => 'classic', 'name' => 'Q&A', 'route' => 'home'],
        ['type' => 'classic', 'name' => 'Tin tức - Hoạt động', 'route' => 'news'],
        ['type' => 'classic', 'name' => 'Giới thiệu', 'route' => 'about'],
        ['type' => 'dropdown', 'name' => 'Quản lý', 'route' => 'manage', 'visible' => Auth::check(), 'items' => [
            ['name' => 'Q&A', 'route' => 'faq', 'icon' => 'fa-question']
        ]],
    ];
@endphp
@foreach($navigators as $nav)
    @include('partials.navigator.' . $nav['type'] . '_navigator', $nav)
@endforeach
{{--@if(Auth::check())--}}
{{--<li class="@hasSection('mobile') nav-item @endif @yield('menu.manage') classic-menu-dropdown">--}}
{{--<a href="javascript:" class="@hasSection('mobile') nav-link nav-toggle @endif" data-hover="megamenu-dropdown"--}}
{{--data-close-other="true">--}}
{{--Quản trị--}}
{{--<i class="fa fa-angle-down"></i>--}}
{{--<span class="@hasSection('menu.manage') selected @endif"> </span>--}}
{{--</a>--}}
{{--<ul class="dropdown-menu pull-left">--}}
{{--<li>--}}
{{--<a href="javascript:">--}}
{{--<i class="fa fa-question"></i>--}}
{{--Q&A--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}
{{--@endif--}}