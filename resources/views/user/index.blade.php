@extends('layouts.datatables')

@section('page-title', 'Danh sách người dùng')

@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Người dùng</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Danh sách người dùng</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('manage.user.create')}}" class="btn blue">
                        <i class="fa fa-plus"></i>
                        Thêm người dùng
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
