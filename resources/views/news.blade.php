@extends('layouts.app')

@section('title', 'Tin tức - Hoạt động')

@section('menu.news', 'active')

@section('page_level_plugins.styles')
    @parent
    {!! Html::style('metronic/global/plugins/cubeportfolio/css/cubeportfolio.css') !!}
@endsection

@section('page_level_styles')
    @parent
    {!! Html::style('metronic/pages/css/portfolio.min.css') !!}
@endsection

@section('styles')
    @parent
    {!! Html::style('css/news.css') !!}
@endsection

@section('scripts.top')
    @parent
    {!! Html::script('js/utils.js') !!}
@endsection

@section('page_content')
    <div class="page-content">
        <div class="portfolio-content portfolio-1">
            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> Tất
                    cả
                    <div class="cbp-filter-counter"></div>
                </div>
                <div data-filter=".category-{{$cat_news_id}}" class="cbp-filter-item btn dark btn-outline uppercase">
                    Tin tức
                    <div class="cbp-filter-counter"></div>
                </div>
                <div data-filter=".category-{{$cat_act_id}}" class="cbp-filter-item btn dark btn-outline uppercase">
                    Hoạt động
                    <div class="cbp-filter-counter"></div>
                </div>
            </div>
            <div id="js-grid-juicy-projects" class="cbp">
                @foreach($articles as $article)
                    <div class="cbp-item category-{{$article->category_id}}">
                        <div class="cbp-caption">
                            <div class="cbp-caption-defaultWrap">
                                {!! Html::image('img/SGUET.jpg', null, ['id' => 'img-'.$article->id]) !!}
                                @if($article->image_url)
                                    <script async>
                                        replaceImgAsync('{{$article->image_url}}', $('#img-{{$article->id}}'));
                                    </script>
                                @endif
                            </div>
                            <div class="cbp-caption-activeWrap">
                                <div class="cbp-l-caption-alignCenter">
                                    <div class="cbp-l-caption-body">
                                        {!! Html::link('javascript:', 'xem thêm', ['rel' => 'nofollow', 'class' => 'cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase']) !!}
                                        {!! Html::link('javascript:', 'xem ảnh', ['data-title' => $article->title, 'class' => 'cbp-lightbox cbp-l-caption-buttonRight btn red uppercase']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cbp-l-grid-projects-title uppercase text-center">{{$article->title}}</div>
                        <div class="cbp-l-grid-projects-desc uppercase text-center">{{$article->short_description ? $article->short_description : '&nbsp;'}}</div>
                    </div>
                @endforeach
            </div>
            <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                <a href="{!! URL::route('api.news.index') !!}"
                   class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow" id="loadMore_btn">
                    <span class="cbp-l-loadMore-defaultText">Xem thêm</span>
                    <span class="cbp-l-loadMore-loadingText">Đang tải...</span>
                    <span class="cbp-l-loadMore-noMoreLoading">Hết rồi :v</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('page_level_plugins.scripts')
    @parent
    {!! Html::script('metronic/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') !!}
@endsection

@section('page_level_scripts')
    @parent
    <script>
        $.news_api_url = '{!! URL::route('api.news.index') !!}'
    </script>
    {!! Html::script('js/news.js') !!}
@endsection

@section('scripts')
    @parent
    <script>
        $('#loadMore_btn').on('click', load_more);
    </script>
@endsection