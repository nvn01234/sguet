@extends('layouts.page')

@section('page-title', 'Sửa Q&A')
@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('manage.faq')}}" >UET Q&A</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('faq.slug', $faq->slug)}}">{{$faq->question}}</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Sửa</span>
    </li>
@endsection

@section('page-level-plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
@endsection

@section('page-body')
    <div class="portlet light">
        <div class="portlet-body form">
            {!! Form::model($faq, ['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'route' => ['manage.faq.update', $faq->id]]) !!}
            <div class="form-body">

                <div class="form-group form-md-line-input @if($errors->has('question')) has-error @endif">
                    {!! Form::label('question', 'Câu hỏi <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::text('question', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Câu hỏi', 'autofocus' => true, 'maxlength' => 255]) !!}
                        <div class="form-control-focus"></div>
                        <span class="help-block {{$errors->has('question') ? 'help-block-error' : ''}}">{{$errors->first('question')}}</span>
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('answer')) has-error @endif">
                    {!! Form::label('answer', 'Trả lời <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                    <div class="col-md-10">
                        {!! Form::textarea('answer', null, ['class' => 'form-control summernote', 'rows' => 20, 'required' => true]) !!}
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('paraphrases')) has-error @endif">
                    {!! Form::label('paraphrases', 'Câu hỏi tương tự', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::text('paraphrases', null, ['class' => 'tagsinput', 'data-help-block' => 'Các câu cách nhau bởi dấu phẩy (,)', 'placeholder' => 'Câu hỏi tương tự']) !!}
                    </div>
                </div>

                <div class="form-group form-md-line-input @if($errors->has('tags')) has-error @endif">
                    {!! Form::label('tags', 'Nhãn', ['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-10">
                        {!! Form::select('tags[]', [], null, ['multiple' => 'multiple', 'class' => 'tagsinput', 'data-help-block' => 'Các nhãn cách nhau bởi dấu phẩy (,)', 'data-placeholder' => 'Nhãn', 'id' => 'tags']) !!}
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn blue">
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>

@endsection

@section('page-level-plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/bootstrap-summernote/summernote.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('metronic/global/plugins/typeahead/handlebars.min.js') !!}
    {!! Html::script('metronic/global/plugins/typeahead/typeahead.bundle.min.js') !!}
@endsection

@section('page-level-scripts')
    @parent
    {{ Html::script('js/sguet/summernote.js') }}
    {{ Html::script('js/sguet/tagsinput.js') }}
    <script>
        $(function() {
            initSummernote();
            initTagsinput();

            var original_tags = $('#original_tags');
            @foreach($faq->tags as $tag)
            original_tags.tagsinput('add', '{{$tag->name}}');
            @endforeach
        });
    </script>
@endsection