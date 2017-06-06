@extends('layouts.datatables')

@section('page-title', 'Có thể bạn sẽ cần')

@section('page-breadcrumb')
    @if(Route::currentRouteNamed('manage.links'))
        <li>
            <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">Quản lý</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('manage.links')}}">Links</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Danh sách links</span>
        </li>
    @else
        <li>
            <a href="{{route('home')}}">Trang chủ</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>Links</span>
        </li>
    @endif
@endsection


@section('table-toolbar')
    @permission('manage-content')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('manage.links.create')}}" class="btn blue">
                        <i class="fa fa-plus"></i>
                        Thêm link
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endpermission
@endsection