@extends('layouts.datatables')

@section('page-title', 'Sao lưu CSDL')

@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Sao lưu CSDL</span>
    </li>
@endsection

@section('table-toolbar')
    <div class="table-toolbar">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    {{Form::open(['method' => 'post', 'route' => 'manage.backup.run'])}}
                    <button class="btn green" type="submit">
                        <i class="fa fa-database"></i> Sao lưu
                    </button>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection