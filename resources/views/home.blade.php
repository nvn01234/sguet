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
                <h1 id="top_heading">Support Group UET</h1>
                <h2>CLB Hỗ trợ sinh viên Trường ĐH Công nghệ</h2>
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 input-group"
                     style="text-align:left">
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
        <div class="row margin-top-20 faq-page faq-content-1" id="search_result" @if(!$faq) hidden="hidden" @endif>
            <div class="faq-content-container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                        <div class="portlet light faq-section">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-search font-blue-hoki"></i>
                                    <span class="caption-subject font-blue-hoki" id="search_result_title">
                                        {{$faq ? $faq->title : ''}}
                                    </span>
                                    <span class="caption-helper" id="search_result_count"></span>
                                </div>
                                <div class="actions">
                                    <button class="btn btn-circle btn-icon-only btn-default back hide"
                                            id="back_btn"></button>
                                    <button class="btn btn-circle btn-icon-only btn-default copylink {{$faq ? '' : 'hide'}}"
                                            id="copylink_btn"></button>
                                    <button class="btn btn-circle btn-icon-only btn-default fullscreen"
                                            title="Toàn màn hình"></button>
                                </div>
                            </div>
                            <div class="portlet-body panel-group accordion faq-content">
                                <div class="scroller" id="search_result_body" data-rail-visible="1">
                                    {!! $faq ? $faq->body : '' !!}
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
    </script>
    {!! Html::script('js/home.js') !!}
    @if($faq)
        <script>
            cache.index = 0;
            cache.response = [{!! $faq !!}];
        </script>
    @endif
@endsection