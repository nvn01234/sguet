@extends('layouts.page')

@section('page-level-styles')
    @parent
    {{ Html::style('css/sguet/cover-image.css') }}
    <style>
        @media (min-width: 992px) {
            .vertical-center {
                margin-top: calc(
                        (100vh
                        - (58px + 33px)
                        - 313px) / 2
                        - 25px
                );
            }
        }
    </style>
@endsection

@section('page-body')
    <div class="row vertical-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-sign-in"></i> Đăng nhập
                    </div>
                </div>
                <div class="portlet-body">
                    {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'login']) !!}

                    <div class="form-group form-md-line-input {{ $errors->has('username') ? ' has-error' : '' }}">
                        {!! Form::label('username', 'Tên đăng nhập <span class="required">*</span>', ['class' => 'col-md-4 control-label'], false) !!}
                        <div class="col-md-6">
                            {!! Form::text('username', null, ['class' => 'form-control', 'required' => true, 'autofocus' => true, 'placeholder' => 'Tên đăng nhập']) !!}
                            <div class="form-control-focus"></div>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-md-line-input {{ $errors->has('password') ? ' has-error' : '' }}">
                        {!! Form::label('password', 'Mật khẩu <span class="required">*</span>', ['class' => 'col-md-4 control-label'], false) !!}
                        <div class="col-md-6">
                            <div class="input-icon">
                                {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Mật khẩu']) !!}
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
                                    {!! Form::label('remember', '<span></span><span class="check"></span><span class="box"></span> Nhớ phiên đăng nhập', [], false) !!}
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
@endsection
