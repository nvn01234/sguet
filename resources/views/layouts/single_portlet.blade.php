@extends('layouts.app')

@section('page_content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings"></i>
                        @yield('title')
                    </div>
                </div>
                <div class="portlet-body">
                    @yield('portlet-body')
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection