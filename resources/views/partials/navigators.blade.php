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