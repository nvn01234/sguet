@extends('layouts.form', ['button' => 'Cập nhật'])

@section('title', 'Sửa thông tin ' . ($role ? $role->display_name : 'Người dùng') . ' ' . $user->name)

@section('form-open')
    {!! Form::model($user, ['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('name')) has-error @endif">
        {!! Form::label('name', 'Tên' . view('partials.span_required')->render(), ['class' => 'col-md-2 control-label'], false)!!}
        <div class="col-md-10">
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('username')) has-error @endif">
        {!! Form::label('username', 'Tên đăng nhập' . view('partials.span_required')->render(), ['class' => 'col-md-2 control-label'], false) !!}
        <div class="col-md-10">
            {!! Form::text('username', old('username'), ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
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
                    {!! Form::radio('role_id', $role->id, $role->id == $selected_role->id, ['class' => 'md-radiobtn', 'id' => 'role_id_' . $role->id]) !!}
                    {!! Form::label('role_id_' . $role->id, view('partials.checkbox')->render() . $role->display_name, [], false) !!}
                </div>
            @endforeach
        </div>
    </div>
@endsection