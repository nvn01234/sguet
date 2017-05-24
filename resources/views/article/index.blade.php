@extends('layouts.datatables')

@section('page-title', 'Danh sách Tin tức - Hoạt động')

@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Tin tức - Hoạt động</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Danh sách Tin tức - Hoạt động</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('manage.article.create')}}" class="btn blue">
                        <i class="fa fa-plus"></i>
                        Đăng bài mới
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection