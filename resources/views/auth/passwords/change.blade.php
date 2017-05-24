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
                            <i class="fa fa-key"></i> Đổi mật khẩu
                        </div>
                    </div>
                    <div class="portlet-body">
                        {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal']) !!}

                        <div class="form-group form-md-line-input {{ $errors->has('old_password') ? ' has-error' : '' }}">
                            {!! Form::label('old_password', 'Mật khẩu cũ <span class="required">*</span>', ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('old_password', ['class' => 'form-control', 'required' => true, 'maxLength' => 255, 'placeholder' => 'Mật khẩu cũ']) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    <span class="help-block {{$errors->has('old_password') ? 'help-block-error' : ''}}">
                                        {{ $errors->first('old_password') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', 'Mật khẩu mới <span class="required">*</span>', ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'maxLength' => 255, 'placeholder' => 'Mật khẩu mới']) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    <span class="help-block {{$errors->has('password') ? 'help-block-error' : ''}}">
                                        {{ $errors->first('password') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-md-line-input {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('password_confirmation', 'Nhập lại mật khẩu mới <span class="required">*</span>', ['class' => 'col-md-4 control-label'], false) !!}
                            <div class="col-md-6">
                                <div class="input-icon">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true, 'maxLength' => 255, 'placeholder' => 'Nhập lại mật khẩu mới']) !!}
                                    <div class="form-control-focus"></div>
                                    <i class="fa fa-key"></i>
                                    <div class="help-block {{$errors->has('password_confirmation') ? 'help-block-error' : ''}}">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
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
@endsection
