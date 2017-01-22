@extends('layouts.app')

@section('title', 'Giới thiệu về SGUET')

@section('menu.about', 'active')

@section('page_level_styles')
    @parent
    {!! Html::style('metronic/pages/css/about.min.css') !!}
@endsection

@section('page_content')
    <div class="page-content">
        <!-- BEGIN CARDS -->
        <div class="row margin-bottom-20">
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-user-follow font-red-sunglo theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span> Best User Expierence </span>
                    </div>
                    <div class="card-desc">
                                    <span> The best way to find yourself is
                                        <br> to lose yourself in the service of others </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-trophy font-green-haze theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span> Awards Winner </span>
                    </div>
                    <div class="card-desc">
                                    <span> The best way to find yourself is
                                        <br> to lose yourself in the service of others </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-basket font-purple-wisteria theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span> eCommerce Components </span>
                    </div>
                    <div class="card-desc">
                                    <span> The best way to find yourself is
                                        <br> to lose yourself in the service of others </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="portlet light">
                    <div class="card-icon">
                        <i class="icon-layers font-blue theme-font"></i>
                    </div>
                    <div class="card-title">
                        <span> Adaptive Components </span>
                    </div>
                    <div class="card-desc">
                                    <span> The best way to find yourself is
                                        <br> to lose yourself in the service of others </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CARDS -->

        <div class="row">
            <div class="col-sm-12">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="actions">
                            <button id="zoomToFit">Zoom to Fit</button>
                            <button id="centerRoot">Center on root</button>
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