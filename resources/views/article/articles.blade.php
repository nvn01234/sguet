@extends('layouts.page')

@section('page-level-plugins.styles')
    @parent
    {{ Html::style('metronic/global/plugins/cubeportfolio/css/cubeportfolio.css') }}
@endsection

@section('page-level-styles')
    @parent
    {{ Html::style('metronic/pages/css/portfolio.min.css') }}
    {{ Html::style('metronic/pages/css/blog.min.css') }}
@endsection

@section('page-breadcrumb')
    <li>
        <a href="{{route('home')}}">Trang chủ</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Tin tức - Hoạt động</span>
    </li>
@endsection
@section('page-title', 'Tin tức - Hoạt động')
@section('title', 'Tin tức - Hoạt động | SGUET')

@section('page-body')
    <div class="portlet light">
        <div class="portfolio-content portfolio-1">
            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                <div data-filter="*"
                     class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase">
                    Tất cả
                    <div class="cbp-filter-counter"></div>
                </div>
                @foreach($categories as $category)
                    <div data-filter=".category-{{$category->id}}"
                         class="cbp-filter-item btn dark btn-outline uppercase">
                        {{$category->name}}
                        <div class="cbp-filter-counter"></div>
                    </div>
                @endforeach
            </div>
            <div id="js-grid-juicy-projects" class="cbp">
                @foreach($articles as $article)
                    @include('api.article_item')
                @endforeach
            </div>
            <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                <a href="{{route('articles')}}"
                   class="cbp-l-loadMore-link btn blue" rel="nofollow" id="loadMore_btn">
                    <span class="cbp-l-loadMore-defaultText">Xem thêm</span>
                    <span class="cbp-l-loadMore-loadingText">Đang tải...</span>
                    <span class="cbp-l-loadMore-noMoreLoading">Hết rồi :v</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('page-level-plugins.scripts')
    @parent
    {{ Html::script('metronic/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js') }}
@endsection

@section('page-level-scripts')
    @parent
    <script>
        var next_page = 1;

        $(function () {
            $('#js-grid-juicy-projects').cubeportfolio({
                filters: '#js-filters-juicy-projects',
                loadMore: '#js-loadMore-juicy-projects',
                loadMoreAction: 'click',
                layoutMode: 'grid',
                defaultFilter: '*',
                animationType: 'quicksand',
                gapHorizontal: 35,
                gapVertical: 30,
                gridAdjustment: 'responsive',
                mediaQueries: [{
                    width: 1100,
                    cols: 4
                }, {
                    width: 800,
                    cols: 3
                }, {
                    width: 480,
                    cols: 2
                }, {
                    width: 320,
                    cols: 1
                }],
                caption: 'overlayBottomReveal',
                displayType: 'sequentially',
                displayTypeSpeed: 80,

                // lightbox
                lightboxDelegate: '.cbp-lightbox',
                lightboxGallery: true,
                lightboxTitleSrc: 'data-title',
                lightboxCounter: '<div class="cbp-popup-lightbox-counter">Bài @{{current}} / @{{total}}</div>',

                // singlePage popup
                singlePageDelegate: '.cbp-singlePage',
                singlePageDeeplinking: true,
                singlePageStickyNavigation: true,
                singlePageCounter: '<div class="cbp-popup-singlePage-counter">Bài @{{current}} / @{{total}}</div>',
                singlePageCallback: function (url, element) {
                    // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                    var t = this;

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html',
                        timeout: 10000
                    })
                        .done(function (result) {
                            t.updateSinglePage(result);
                        })
                        .fail(function () {
                            t.updateSinglePage('Có lỗi trong quá trình tải tin tức! Vui lòng thử lại sau!');
                        });
                }
            });

            $('#loadMore_btn').on('click', function () {
                next_page++;
                $('#loadMore_btn').attr('href', '{{route('articles')}}?page=' + next_page);
            });
        });
    </script>
@endsection