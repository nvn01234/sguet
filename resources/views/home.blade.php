@extends('layouts.app')

@section('menu.home', 'active')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/typeahead/typeahead.css') !!}
@endsection

@section('page_level_styles')
    {!! Html::style('metronic/pages/css/about.min.css') !!}
@endsection

@section('styles')
    <style type="text/css">
        .about-header {
            height: 100vh;
        }

        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('page_content')
    <div class="row about-header">
        <div class="col-md-12">
            <h1>Support Group UET</h1>
            <h2>CLB Hỗ trợ sinh viên Trường ĐH Công nghệ</h2>
            <div class="col-md-6 col-md-offset-3 input-group" style="text-align:left">
                <input type="text" class="form-control" name="question" id="search"
                       placeholder="Nhập câu hỏi">
                <span class="input-group-btn">
                    <a href="javascript:" class="btn green">
                        <i class="fa fa-search"></i> Tìm kiếm
                    </a>
                </span>
            </div>
        </div>
    </div>
@endsection

@section('page_level_plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/typeahead/handlebars.min.js') !!}
    {!! Html::script('metronic/global/plugins/typeahead/typeahead.bundle.min.js') !!}
@endsection

@section('page_level_scripts')
    @parent
    {!! Html::script('metronic/pages/scripts/components-typeahead.min.js') !!}
@endsection