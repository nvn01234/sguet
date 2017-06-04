@extends('layouts.base')

@section('body')
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <div class="page-logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('img/SGUET.png')}}" alt="logo" class="logo-default" height="26">
                </a>
            </div>

            @include('partials.master.hor-menu')

            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
            </a>

            @if(Auth::check())
                @include('partials.master.top-menu')
            @endif
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="page-container">
        @include('partials.master.page-sidebar')

        <div class="page-content-wrapper">
            <div class="page-content @permission('manage-content') sidebar-visible @endpermission">
                @yield('page')
            </div>
        </div>
    </div>

    <div class="page-footer">
        <div class="page-footer-inner" style="margin-left: 40px">
            2017 © {{config('app.name')}}
        </div>
        <div class="page-footer-inner pull-right" style="margin-right: 40px;">
            <a href="{{route('feedback.create')}}">Liên hệ</a> | <a href="{{route('links')}}"><i class="fa fa-link"></i></a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
@endsection