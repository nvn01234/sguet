@extends('layouts.app')

@section('title', 'Đổi mật khẩu')

@section('styles')
    @parent
    {!! Html::style('css/home.css') !!}
@endsection

@section('page_content')
    <div class="about-header">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="portlet box blue" style="margin-top: 130px">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-key"></i> Đổi mật khẩu
                        </div>
                    </div>
                    <div class="portlet-body">
                        {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                        {!! Form::hidden('remember_token', $user->remember_token) !!}

                        <div class="form-group form-md-line-input {{ $errors->has('old_password') ? ' has-error' : '' }}">
                            {!! Form::label('old_password', 'Mật khẩu cũ ' . view('partials.span_required')->render(), ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('old_password', ['class' => 'form-control', 'required' => true, 'maxLength' => 255]) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    @if ($errors->has('old_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Mật khẩu mới ' . view('partials.span_required')->render(), ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'maxLength' => 255]) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('password_confirmation', 'Nhập lại mật khẩu mới ' . view('partials.span_required')->render(), ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true, 'maxLength' => 255]) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Thay đổi', ['class' => 'btn blue']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
