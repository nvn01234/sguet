@extends('layouts.app')

@section('menu.home', 'active')

@section('page_level_styles')
    {!! Html::style('metronic/pages/css/about.min.css') !!}
@endsection

@section('styles')
    {!! Html::style('css/home.css') !!}
@endsection

@section('page_content')
    <div class="about-header">
        <div class="row">
            <div class="col-md-12">
                <h1 id="top_heading">Support Group UET</h1>
                <h2>CLB Hỗ trợ sinh viên Trường ĐH Công nghệ</h2>
                <div class="col-md-6 col-md-offset-3 input-group" style="text-align:left">
                    <input type="text" class="form-control" name="question" id="search_input"
                           placeholder="Nhập câu hỏi">
                    <span class="input-group-btn">
                        <button type="submit" class="btn green" id="search_btn">
                            <i class="fa fa-search"></i> Tìm kiếm
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row search-result" id="search_result" hidden="hidden">
            <div class="col-md-6 col-md-offset-3">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search font-blue-hoki"></i>
                            <span class="caption-subject font-blue-hoki" id="search_result_title"></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller search-result-body" data-rail-visible="1" data-rail-color="yellow"
                             data-handle-color="#a1b2bd" id="search_result_body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    {!! Html::script('js/home.js') !!}
    <script type="text/javascript">
        var btn = $('#search_btn');
        var input = $('#search_input');
        var result = $('#search_result');
        var result_title = $('#search_result_title');
        var result_body = $('#search_result_body');
        var top_heading = $('#top_heading');
        setupSearch(btn, input, result, result_title, result_body, top_heading);
    </script>
@endsection