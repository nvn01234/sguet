@extends('layouts.page')

@section('page-title', 'Thêm link')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('manage.links')}}" >Links</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Thêm link</span>
    </li>
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body form">
            {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'manage.links.store']) !!}
            <div class="form-body">

                <div class="form-group form-md-line-input @if($errors->has('url')) has-error @endif">
                    {!! Form::label('url', 'Đường dẫn <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::url('url', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Đường dẫn', 'autofocus' => true, 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('url') ? 'help-block-error' : ''}}">{{$errors->first('url')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('description')) has-error @endif">
                    {!! Form::label('description', 'Mô tả', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Mô tả', 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('description') ? 'help-block-error' : ''}}">{{$errors->first('description')}}</span>
                    </div>
                </div>

            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn blue">
                            Thêm link
                        </button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection