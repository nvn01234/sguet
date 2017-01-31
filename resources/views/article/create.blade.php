@extends('layouts.form', ['button' => 'Tạo'])

@section('title', 'Tạo mới Tin tức - Hoạt động')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') !!}
@endsection

@section('form-open')
    {!! Form::open(['method' => 'post', 'role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
@endsection

@section('form-body')
    <div class="form-group form-md-line-input @if($errors->has('title')) has-error @endif">
        {!! Form::label('title', 'Tiêu đề (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('image_url')) has-error @endif">
        {!! Form::label('image', 'Hình ảnh', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                     style="width: 200px; height: 150px;"></div>
                <div>
                    <span class="btn red btn-outline btn-file">
                        <span class="fileinput-new"> Chọn ảnh </span>
                        <span class="fileinput-exists"> Đổi ảnh </span>
                        {!! Form::file('image', ['accept' => 'image/*']) !!}
                    </span>
                    <a href="javascript:" class="btn red fileinput-exists" data-dismiss="fileinput"> Xoá </a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('short_description')) has-error @endif">
        {!! Form::label('short_description', 'Mô tả (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::text('short_description', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255]) !!}
            <div class="form-control-focus"></div>
        </div>
    </div>

    <div class="form-group form-md-line-input @if($errors->has('body')) has-error @endif">
        {!! Form::label('body', 'Nội dung (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::textarea('body', null, ['class' => 'form-control summernote', 'rows' => 20, 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group form-md-line-input">
        {!! Form::label('category_id', 'Loại (*)', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-md-10">
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'required' => 'required']) !!}
            <div class="form-control-focus"></div>
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
    {!! Html::script('metronic/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') !!}
@endsection

@section('scripts')
    @parent
    {!! Html::script('js/utils.js') !!}
    <script>
        $(document).ready(function () {
            summernote();
            tagsinput();
        })
    </script>
@endsection