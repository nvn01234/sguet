@extends('layouts.form', ['button' => 'Cập nhật'])

@section('title', 'Sửa ' . $faq->question)

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
@endsection

@section('form-open')
    {!! Form::model($faq, ['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('question')) has-error @endif">
        {!! Form::label('question', 'Câu hỏi '. view('partials.span_required')->render(), ['class' => 'col-md-2 control-label'], false) !!}
        <div class="col-md-10">
            {!! Form::text('question', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
            <span class="help-block"></span>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('answer')) has-error @endif">
        {!! Form::label('answer', 'Trả lời '. view('partials.span_required')->render(), ['class' => 'col-md-2 control-label'], false) !!}
        <div class="col-md-10">
            {!! Form::textarea('answer', null, ['class' => 'form-control summernote', 'rows' => 20, 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('paraphrases')) has-error @endif">
        {!! Form::label('paraphrases', 'Câu hỏi tương tự', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('paraphrases', null, ['class' => 'tagsinput', 'data-help-block' => 'Các câu cách nhau bởi dấu phẩy (,)']) !!}
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('tags')) has-error @endif">
        {!! Form::label('tags', 'Nhãn', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::select('tags[]', [], null, ['multiple' => 'multiple', 'class' => 'tagsinput', 'data-help-block' => 'Các nhãn cách nhau bởi dấu phẩy (,)']) !!}
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
        const initPraphrases = (tagsinput) => {
            tagsinput = $(tagsinput);
            @foreach($paraphrases as $paraphrase)
            tagsinput.tagsinput('add', '{{$paraphrase}}');
            @endforeach
        };

        const initTags = (tagsinput) => {
            tagsinput = $(tagsinput);
            @foreach($faq->tags as $tag)
            tagsinput.tagsinput('add', '{{$tag->name}}');
            @endforeach
        };

        $(document).ready(function () {
            summernote();
            tagsinput([initPraphrases, initTags]);
        })
    </script>
@endsection