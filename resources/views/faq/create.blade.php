@extends('layouts.form', ['button' => 'Tạo'])

@section('title', 'Tạo mới Q&A')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
@endsection

@section('form-open')
    {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('question')) has-error @endif">
        {!! Form::label('question', 'Câu hỏi (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('question', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('answer')) has-error @endif">
        {!! Form::label('answer', 'Trả lời (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::textarea('answer', null, ['class' => 'form-control summernote', 'rows' => 20, 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('tags')) has-error @endif">
        {!! Form::label('tags', 'Nhãn', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::select('tags[]', [], null, ['multiple' => 'multiple', 'data-role' => 'tagsinput', 'data-help-block' => 'Các nhãn cách nhau bởi dấu phẩy (,)']) !!}
        </div>
    </div>
@endsection

@section('page_level_plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/bootstrap-summernote/summernote.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('metronic/global/plugins/typeahead/handlebars.min.js') !!}
    {!! Html::script('metronic/global/plugins/typeahead/typeahead.bundle.min.js') !!}
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            summernote();
            tagsinput();
        })
    </script>
@endsection