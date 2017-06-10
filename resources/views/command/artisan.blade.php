@extends('layouts.page')

@section('page-title', 'Artisan')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Artisan</span>
    </li>
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body form">
            {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'manage.command.artisan.call']) !!}
            <div class="form-body">
                <div class="form-group form-md-line-input @if($errors->has('cmd')) has-error @endif">
                    {!! Form::label('cmd', 'Lệnh', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::text('cmd', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Lệnh', 'autofocus' => true]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('cmd') ? 'help-block-error' : ''}}">{{$errors->first('cmd')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('params')) has-error @endif">
                    {!! Form::label('params', 'Tham số', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('params', null, ['class' => 'form-control', 'placeholder' => 'Tham số']) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('params') ? 'help-block-error' : ''}}">{{$errors->first('params')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input">
                    {!! Form::label('response', 'Phản hồi', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('response', null, ['class' => 'form-control', 'placeholder' => 'Phản hồi', 'disabled' => true]) !!}
                        <div class="form-control-focus"></div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn blue">
                            Thực thi
                        </button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
@endsection