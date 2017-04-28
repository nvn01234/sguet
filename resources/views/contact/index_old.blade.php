@extends('layouts.single_portlet')

@if(Route::currentRouteNamed('manage.contact'))
    @section('menu.manage', 'active')
@section('menu.manage.contact', 'active')
@else
    @section('menu.contacts', 'active')
@endif

@section('title', 'Danh bạ Trường Đại học Công nghệ')

@section('page_level_styles')
    @parent
    <style>
        table {
            width: 100% !important;
        }
    </style>
@endsection

@section('icon', 'fa fa-phone')

@section('portlet-body')
    @if(Auth::check())
        <div class="table-toolbar">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group pull-right" id="manage">
                        <a class="btn btn-default " href="javascript:;" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog"></i> Quản lý
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{route('manage.faq.edit', $faq->id)}}">
                                    <i class="fa fa-upload"></i> Sửa </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {!! $faq->answer !!}
@endsection