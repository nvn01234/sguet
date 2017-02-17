@extends('layouts.app')

@section('title', 'Đăng nhập')

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
                            <i class="fa fa-sign-in"></i> Đăng nhập
                        </div>
                    </div>
                    <div class="portlet-body">
                        {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'login.post']) !!}

                        <div class="form-group form-md-line-input {{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username', 'Tên đăng nhập ' . view('partials.span_required')->render(), ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                {!! Form::text('username', old('username'), ['class' => 'form-control', 'required' => true, 'autofocus' => true, 'maxLength' => 255]) !!}
                                <div class="form-control-focus"></div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Mật khẩu ' . view('partials.span_required')->render(), ['class' => 'col-md-4 control-label'], false) !!}
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

                        <div class="form-group form-md-line-input">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="md-checkbox-list">
                                    <div class="md-checkbox">
                                        {!! Form::checkbox('remember', 1, true, ['class' => 'md-check', 'id' => 'remember']) !!}
                                        {!! Form::label('remember', view('partials.checkbox')->render() . ' Nhớ phiên đăng nhập', [], false) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {!! Form::submit('Đăng nhập', ['class' => 'btn blue']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
