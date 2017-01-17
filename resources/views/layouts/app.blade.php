@extends('layouts.base_app')

@section('page_level_plugins.styles')
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

    <div class="scroll-to-top" style="display: none;">
        <i class="icon-arrow-up"></i>
    </div>
@endsection

@section('page_level_plugins.scripts')
    {!! Html::script('metronic/global/plugins/bootstrap-toastr/toastr.min.js') !!}
@endsection

@section('page_level_scripts')
    {!! Html::script('metronic/pages/scripts/ui-toastr.min.js') !!}
@endsection

@section('scripts')
    @include('vendor.flash.toastr')
@endsection