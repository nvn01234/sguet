@extends('layouts.master')

@section('page')
    @hasSection('page-breadcrumb')
        <div class="page-bar">
            <ul class="page-breadcrumb">
                @yield('page-breadcrumb')
            </ul>
        </div>
    @endif

    @hasSection('page-title')
        <h3 class="page-title">
            @yield('page-title')
            <small>@yield('page-description')</small>
        </h3>
    @endif

    @yield('page-body')
@endsection