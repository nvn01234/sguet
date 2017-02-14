@extends('layouts.form', ['button' => 'Tạo'])

@section('title', 'Tạo mới Người dùng')

@section('form-open')
    {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Tên người dùng (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('username')) has-error @endif">
        {!! Form::label('username', 'Tên đăng nhập (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('username', old('username'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('password')) has-error @endif">
        {!! Form::label('password', 'Mật khẩu (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'maxLength' => 100]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('password_confirmation')) has-error @endif">
        {!! Form::label('password_confirmation', 'Nhập lại mật khẩu (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'maxLength' => 100]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>
@endsection