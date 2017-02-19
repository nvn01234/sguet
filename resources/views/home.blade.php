@extends('layouts.app')

@section('menu.home', 'active')

@section('page_level_styles')
    @parent
    {!! Html::style('metronic/pages/css/about.min.css') !!}
    {!! Html::style('metronic/pages/css/faq.min.css') !!}
@endsection

@section('styles')
    @parent
    {!! Html::style('css/home.css') !!}
@endsection

@section('page_content')
    <div class="about-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="container">
                    <div class="row" id="top_heading">
                        <div class="col-md-2 col-md-offset-2 hidden-sm hidden-xs">
                            {!! Html::image('img/SGUET.png', null, ['class' => 'logo']) !!}
                        </div>
                        <div class="col-lg-6 col-md-7">
                            <h1>Support Group UET</h1>
                            <h2>CLB Hỗ trợ sinh viên Trường ĐH Công nghệ</h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 input-group"
                     style="text-align:left">
                    <input type="text" class="form-control" id="search_input"
                           placeholder="Nhập câu hỏi">
                    <span class="input-group-btn">
                        <button type="button" class="btn blue" id="search_btn">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="row margin-top-20 faq-page faq-content-1" id="search_result"
             @if(!isset($faq)) hidden="hidden" @endif>
            <div class="faq-content-container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="portlet light faq-section">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-search font-blue-hoki"></i>
                                    <span class="caption-subject font-blue-hoki" id="search_result_title">
                                        @if(isset($faq)) {{$faq->question}} @endif
                                    </span>
                                    <span class="caption-helper" id="search_result_count"></span>
                                </div>
                                <div class="actions">
                                    <button class="btn btn-circle btn-icon-only btn-default back hide"
                                            id="back_btn"></button>
                                    @if(Auth::check())
                                        <button class="btn btn-circle btn-icon-only btn-default edit"
                                                id="edit_btn"></button>
                                        <button class="btn btn-circle btn-icon-only btn-default delete"
                                                id="delete_btn"></button>
                                    @endif
                                    <button class="btn btn-circle btn-icon-only btn-default copylink"
                                            id="copylink_btn"></button>
                                    <button class="btn btn-circle btn-icon-only btn-default fullscreen"
                                            title="Toàn màn hình"></button>
                                </div>
                            </div>
                            <div class="portlet-body panel-group accordion faq-content">
                                <div class="scroller" id="search_result_body" data-rail-visible="1">
                                    @if(isset($faq)) {!! $faq->answer !!} @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        var HOME_URL = '{!! URL::route('home') !!}';
        var SEARCH_URL = '{!! URL::route('api.faq.search') !!}';
    </script>
    @if(Auth::check())
        <script>
            var EDIT_URL = '{!! URL::route('manage.faq.edit', ['id' => 'FAQ_ID']) !!}';
            var DELETE_URL = '{!! URL::route('api.faq.delete') !!}';
            var TOKEN = '{!! csrf_token() !!}';
        </script>
    @endif
    {!! Html::script('js/home.js') !!}
    @if(isset($faq))
        <script>
            cache.index = 0;
            cache.response = [{!! $faq !!}];
        </script>
    @endif
@endsection