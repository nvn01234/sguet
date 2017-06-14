@extends('layouts.page')

@section('title', 'Liên hệ SGUET')

@section('page-level-styles')
    @parent
    {{ Html::style('css/sguet/cover-image.css') }}
@endsection

@section('page-body')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i> Liên hệ
                    </div>
                </div>
                <div class="portlet-body">
                    {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'form-horizontal', 'route' => 'feedback.store']) !!}

                    <div class="form-group form-md-line-input {{ $errors->has('name') ? ' has-error' : '' }}">
                        {!! Form::label('name', 'Tên', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-10">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Tên', 'autofocus' => true]) !!}
                            <div class="form-control-focus"></div>
                            @if ($errors->has('name'))
                                <span class="help-block help-block-error">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-md-line-input {{ $errors->has('email') ? ' has-error' : '' }}">
                        {!! Form::label('email', 'Email', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-10">
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            <div class="form-control-focus"></div>
                            @if ($errors->has('name'))
                                <span class="help-block help-block-error">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <span class="help-block help-block-info">
                                Bạn có thể để lại email để chúng tôi có thể liên lạc lại với bạn.
                            </span>
                        </div>
                    </div>

                    <div class="form-group form-md-line-input {{ $errors->has('type') ? ' has-error' : '' }}">
                        {!! Form::label('type', 'Loại <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                        <div class="col-md-10">
                            {!! Form::select('type', \App\Models\Feedback::TYPE, null, ['class' => 'form-control', 'required' => true]) !!}
                            <div class="form-control-focus"></div>
                            @if ($errors->has('type'))
                                <span class="help-block help-block-error">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group form-md-line-input {{ $errors->has('message') ? ' has-error' : '' }}">
                        {!! Form::label('message', 'Nội dung <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                        <div class="col-md-10">
                            {!! Form::textarea('message', null, ['class' => 'form-control autosizeme', 'required' => true, 'placeholder' => 'Nội dung', 'style' => 'resize: vertical']) !!}
                            <div class="form-control-focus"></div>
                            @if ($errors->has('message'))
                                <span class="help-block help-block-error">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            {!! Form::submit('Gửi', ['class' => 'btn blue', 'style' => 'width: 100%']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-plugins.scripts')
    @parent
    {{Html::script('metronic/global/plugins/autosize/autosize.min.js')}}
@endsection