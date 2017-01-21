@extends('layouts.base_app')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-toastr/toastr.min.css') !!}
@endsection

@section('body.class', 'page-sidebar-closed-hide-logo page-content-white page-full-width page-md page-header-fixed')

@section('body.inner')
    @include('partials.header')

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->

    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        @include('partials.sidebar')
        <div class="page-content-wrapper">
            @yield('page_content')
        </div>
    </div>
    <!-- END CONTAINER -->

    <!-- BEGIN FOOTER -->
    <div class="page-footer">
        <div class="page-footer-inner"> 2017 &copy;
            <a href="{!! URL::route('home') !!}">Support Group UET</a>
        </div>
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>
    <!-- END FOOTER -->
@endsection

@section('page_level_plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/bootstrap-toastr/toastr.min.js') !!}
@endsection

@section('page_level_scripts')
    @parent
    {!! Html::script('metronic/pages/scripts/ui-toastr.min.js') !!}
@endsection

@section('scripts')
    @parent
    @include('vendor.flash.toastr')
@endsection