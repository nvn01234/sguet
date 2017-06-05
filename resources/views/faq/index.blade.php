@extends('layouts.datatables')

@section('page-title', 'Danh sách Q&A')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">UET Q&A</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Danh sách Q&A</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a href="{{route('manage.faq.create')}}" class="btn blue">
                        <i class="fa fa-plus"></i>
                        Tạo Q&A
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection