@extends('layouts.form', ['button' => 'Tạo'])

@section('title', 'Tạo mới Người dùng')

@section('form-open')
    {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('name')) has-error @endif">
        <label class="col-md-2 control-label" for="name">
            Tên
            <span class="required" aria-required="true">*</span>
        </label>
        <div class="col-md-10">
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('username')) has-error @endif">
        <label class="col-md-2 control-label" for="username">
            Tên đăng nhập
            <span class="required" aria-required="true">*</span>
        </label>
        <div class="col-md-10">
            {!! Form::text('username', old('username'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('password')) has-error @endif">
        <label class="col-md-2 control-label" for="password">
            Mật khẩu
            <span class="required" aria-required="true">*</span>
        </label>
        <div class="col-md-10 input-icon">
            {!! Form::password('password', ['class' => 'form-control', 'required' => 'required', 'maxLength' => 100]) !!}
            <div class="form-control-focus"></div>
            <i class="fa fa-key"></i>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('password_confirmation')) has-error @endif">
        <label class="col-md-2 control-label" for="password_confirmation">
            Nhập lại mật khẩu
            <span class="required" aria-required="true">*</span>
        </label>
        <div class="col-md-10 input-icon">
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'maxLength' => 100]) !!}
            <div class="form-control-focus"></div>
            <i class="fa fa-key"></i>
        </div>
    </div>

    <div class="form-group form-md-radios">
        <label class="col-md-2 control-label">
            Quyền
            <span class="required" aria-required="true">*</span>
        </label>
        <div class="col-md-10 md-radio-inline">
            @foreach($roles as $role)
                <div class="md-radio">
                    {!! Form::radio('role_ids[]', $role->id, 'selected', ['class' => 'md-radiobtn', 'id' => 'role_id_' . $role->id]) !!}
                    <label for="role_id_{{$role->id}}">
                        <span></span>
                        <span class="check"></span>
                        <span class="box"></span> {{$role->display_name}} </label>
                </div>
            @endforeach
        </div>
    </div>
@endsection