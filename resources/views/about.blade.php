@extends('layouts.app')

@section('title', 'Giới thiệu về SGUET')

@section('menu.about', 'active')

@section('page_level_styles')
    @parent
    {!! Html::style('metronic/pages/css/about.min.css') !!}
@endsection

@section('styles')
    @parent
    {!! Html::style('css/about.css') !!}
@endsection

@section('body.class')
    @parent page-container-bg-solid
@endsection

@section('page_content')
    <div class="page-content">
        <!-- BEGIN CARDS -->
        <div class="row margin-bottom-20">
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="sguet-logo font-red-sunglo theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span>Tên đầy đủ</span>
                    </div>
                    <div class="card-desc">
                        <span>
                            Câu lạc bộ Hỗ trợ sinh viên<br/>
                            Trường Đại học Công nghệ - ĐHQGHN<br/>
                            <i>(Support Group UET)</i><br/>
                            &nbsp;
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-calendar font-green-haze theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span>Ngày thành lập</span>
                    </div>
                    <div class="card-desc">
                        <span>
                            14/12/2012<br/>
                            &nbsp;<br/>
                            &nbsp;<br/>
                            &nbsp;
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-trophy font-purple-wisteria theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span>Sứ mệnh</span>
                    </div>
                    <div class="card-desc">
                        <span>
                            - Giúp đỡ sinh viên trong quá trình học tập<br/>
                            cũng như hoạt động tại trường.<br/>
                            - Quảng bá hình ảnh của Đại học Công nghệ,<br/>
                            sinh viên Công nghệ.
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-call-end font-blue theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span>Liên hệ</span>
                    </div>
                    <div class="card-desc">
                        <span>
                            Email: {!! Html::mailto('lienhe.sguet@gmail.com') !!}<br/>
                            Website: {!! Html::link('https://sguet.com') !!}<br/>
                            Facebook: {!! Html::link('https://www.facebook.com/SupportGroupUET') !!}<br/>
                            SĐT: 098 555 43 52
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CARDS -->

        <div class="row">
            <div class="col-sm-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-users font-blue-hoki"></i>
                            <span class="caption-subject font-blue-hoki">Gia phả</span>
                        </div>
                        <div class="actions">
                            <button class="btn btn-circle btn-icon-only btn-default zoom-to-fit"
                                    id="zoomToFit"></button>
                            <button class="btn btn-circle btn-icon-only btn-default center-on-root"
                                    id="centerRoot"></button>
                            <button class="btn btn-circle btn-icon-only btn-default fullscreen"
                                    title="Toàn màn hình"></button>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div id="myDiagramDiv"
                             style="background-color: white; width: 100%; height: 550px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    {!! Html::script('js/go.js') !!}
    {!! Html::script('js/about.js') !!}
@endsection