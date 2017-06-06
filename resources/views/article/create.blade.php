@extends('layouts.page')

@section('page-level-plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/bootstrap-summernote/summernote.css') !!}
    {!! Html::style('metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') !!}
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
@endsection

@section('page-level-styles')
    @parent
    {!! Html::style('metronic/pages/css/blog.min.css') !!}
@endsection

@section('page-title', 'Đăng tin tức - hoạt động')

@section('page-breadcrumb')
    <li>
        <a href="javascript:" class="sidebar-toggler menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">Quản lý</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('manage.article')}}" >Tin tức - Hoạt động</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Đăng bài</span>
    </li>
@endsection

@section('page-body')
    <div class="blog-page blog-content-2">
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable-line bg-white bordered">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#edit_mode" data-toggle="tab" aria-expanded="false"> Thông tin </a>
                        </li>
                        <li>
                            <a href="#preview_mode" data-toggle="tab"> Xem trước </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="edit_mode">
                        <div class="bg-white bordered form">
                            {{Form::open(['method' => 'post', 'class' => 'form-horizontal', 'route' => 'manage.article.store', 'id' => 'create-article-form'])}}
                            <div class="form-body">
                                <div class="alert alert-info">
                                    <strong>Lưu ý:</strong> Các thay đổi chỉ thực sự được lưu khi bấm <a
                                            href="javascript:" class="alert-link" id="submit-link">Đăng bài</a>.
                                </div>

                                <div class="form-group form-md-line-input @if($errors->has('title')) has-error @endif">
                                    {!! Form::label('title', 'Tiêu đề <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                                    <div class="col-md-10">
                                        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255, 'placeholder' => 'Tiêu đề']) !!}
                                        <div class="form-control-focus"></div>
                                        <div class="help-block {{$errors->has('title') ? 'help-block-error' : ''}}">{{$errors->first('title')}}</div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input @if($errors->has('image_url')) has-error @endif">
                                    {!! Form::label('image_url', 'Hình ảnh', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-10">
                                        {!! Form::url('image_url', null, ['class' => 'form-control', 'maxLength' => 255, 'placeholder' => 'Hình ảnh']) !!}
                                        <div class="form-control-focus"></div>
                                        <div class="help-block {{$errors->has('image_url') ? 'help-block-error' : ''}}">{{$errors->first('image_url')}}</div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input @if($errors->has('short_description')) has-error @endif">
                                    {!! Form::label('short_description', 'Mô tả <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                                    <div class="col-md-10">
                                        {!! Form::text('short_description', null, ['class' => 'form-control', 'required' => 'required', 'maxLength' => 255, 'placeholder' => 'Mô tả']) !!}
                                        <div class="form-control-focus"></div>
                                        <div class="help-block {{$errors->has('short_description') ? 'help-block-error' : ''}}">{{$errors->first('short_description')}}</div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input @if($errors->has('body')) has-error @endif">
                                    {!! Form::label('body', 'Nội dung <span class="required">*</span>', ['class' => 'col-md-2 control-label'], false) !!}
                                    <div class="col-md-10">
                                        {!! Form::textarea('body', null, ['class' => 'form-control summernote', 'rows' => 20, 'required' => true]) !!}
                                        <div class="help-block {{$errors->has('body') ? 'help-block-error' : ''}}">{{$errors->first('body')}}</div>
                                    </div>
                                </div>

                                <div class="form-group form-md-radios {{$errors->has('category_id') ? 'has-error' : ''}}">
                                    <label class="col-md-2 control-label">
                                        Phân loại
                                        <span class="required" aria-required="true">*</span>
                                    </label>
                                    <div class="col-md-10 md-radio-inline">
                                        @foreach($categories as $category)
                                            <div class="md-radio">
                                                {!! Form::radio('category_id', $category->id, null, ['class' => 'md-radiobtn', 'id' => 'category_id_' . $category->id]) !!}
                                                <label for="category_id_{{$category->id}}">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> {{$category->name}} </label>
                                            </div>
                                        @endforeach
                                        <div class="help-block {{$errors->has('category_id') ? 'help-block-error' : ''}}">{{$errors->first('category_id')}}</div>
                                    </div>
                                </div>

                                <div class="form-group form-md-line-input @if($errors->has('tags')) has-error @endif">
                                    {!! Form::label('tags', 'Nhãn', ['class' => 'col-md-2 control-label']) !!}
                                    <div class="col-md-10">
                                        {!! Form::select('tags[]', [], null, ['multiple' => 'multiple', 'class' => 'tagsinput', 'data-help-block' => 'Các nhãn cách nhau bởi dấu phẩy (,)', 'id' => 'tags', 'data-placeholder' => 'Nhãn']) !!}
                                    </div>
                                </div>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="preview_mode">
                        <div class="blog-single-content bordered blog-container">
                            <div class="blog-single-head">
                                <h1 class="blog-single-head-title">

                                </h1>
                                <div class="blog-single-head-date">
                                    <i class="icon-calendar font-blue"></i>
                                    {{\Carbon\Carbon::now()}}
                                </div>
                            </div>
                            <div class="blog-single-img" style="display: none">
                                <img src="" alt="Image">
                            </div>
                            <div class="blog-single-desc">
                            </div>
                            <div class="blog-single-foot">
                                <ul class="blog-post-tags">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="blog-single-sidebar bordered blog-container">
                    <div class="blog-single-sidebar-links">
                        <h3 class="blog-sidebar-title uppercase">
                            <i class="fa fa-cog"></i> Quản lý
                        </h3>
                        <ul>
                            <li>
                                <a href="javascript:" id="submit">
                                    <i class="fa fa-check"></i> Đăng bài
                                </a>
                            </li>
                            <li>
                                <a href="{{route('manage.article')}}">
                                    <i class="fa fa-close"></i> Huỷ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
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
        $(function () {
            initSummernote();
            initTagsinput();

            var original_tags = $('#original_tags');

            original_tags.on('itemAdded itemRemoved', function () {
                var tags = original_tags.val();
                console.log(tags);
                var component = $('.blog-post-tags');
                component.empty();
                tags.forEach(function (tag) {
                    component.append('<li class="uppercase"><a href="javascript:">' + tag + "</a></li>")
                });
            });

            $('#title').change(function () {
                $('.blog-single-head-title').text($(this).val());
            });

            $('#image_url').change(function () {
                var url = $(this).val();
                if (url) {
                    var container = $('.blog-single-img');
                    container.show();
                    container.find('img').attr('src', url);
                } else {
                    $('.blog-single-img').hide();
                }
            });

            $('#original_body').on('summernote.blur', function () {
                $('.blog-single-desc').html($(this).val());
            });

            $('#submit-link').click(function (e) {
                if (App.isIE8()) {
                    return;
                }

                $('#submit').pulsate({
                    color: "#399bc3",
                    repeat: false
                });
            });

            $('#submit').click(function () {
                $('#create-article-form').submit();
            });
        });
    </script>
@endsection