@php
    $navigators = [
        ['type' => 'classic', 'name' => 'Q&A', 'route' => 'home'],
        ['type' => 'classic', 'name' => 'Tin tức - Hoạt động', 'route' => 'articles'],
        ['type' => 'classic', 'name' => 'Giới thiệu', 'route' => 'about'],
        ['type' => 'dropdown', 'name' => 'Quản lý', 'route' => 'manage', 'visible' => Auth::check(), 'items' => [
            ['name' => 'Q&A', 'route' => 'faq', 'icon' => 'fa-question']
        ]],
    ];
@endphp
@foreach($navigators as $nav)
    @include('partials.navigator.' . $nav['type'] . '_navigator', $nav)
@endforeach