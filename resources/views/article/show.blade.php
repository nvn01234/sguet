@extends('layouts.page')

@section('page-level-styles')
    @parent
    {!! Html::style('metronic/pages/css/blog.min.css') !!}
@endsection

@section('title', $article->title)
@section('description', str_limit($article->title . ' - ' . trim(strip_tags($article->body)), config('app.description.limit')))
@section('page-title', $article->title)

@section('page-breadcrumb')
    <li>
        <a href="{{route('home')}}">Trang chủ</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <a href="{{route('articles')}}">Tin tức - Hoạt động</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>{{$article->title}}</span>
    </li>
@endsection

@section('page-body')
    <div class="blog-page blog-content-2">
        <div class="row">
            <div class="col-lg-9">
                <div class="blog-single-content bordered blog-container">
                    <div class="blog-single-head">
                        <h1 class="blog-single-head-title">{{$article->title}}</h1>
                        <div class="blog-single-head-date">
                            <i class="icon-calendar font-blue"></i>
                            {{$article->created_at}}
                        </div>
                    </div>
                    @if($article->image_url)
                        <div class="blog-single-img">
                            {!! Html::image($article->image_url) !!}
                        </div>
                    @endif
                    <div class="blog-single-desc">
                        {!! $article->body !!}
                    </div>
                    <div class="blog-single-foot">
                        <ul class="blog-post-tags">
                            @foreach($article->taggable->tags as $tag)
                                <li class="uppercase">
                                    <a href="javascript:;">{{$tag->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="blog-single-sidebar bordered blog-container">
                    <div class="blog-single-sidebar-recent">
                        <h3 class="blog-sidebar-title uppercase">{{$category->name}} gần đây</h3>
                        <ul>
                            @foreach($recents as $recent)
                                <li>
                                    <a href="{{route('articles.slug', $recent->slug)}}">{{$recent->title}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="blog-single-sidebar-tags">
                        <h3 class="blog-sidebar-title uppercase">Nhãn</h3>
                        <ul class="blog-post-tags">
                            @foreach($article->taggable->tags as $tag)
                                <li class="uppercase">
                                    <a href="javascript:;">{{$tag->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @permission('manage-content')
                        <div class="blog-single-sidebar-links">
                            <h3 class="blog-sidebar-title uppercase">
                                <i class="fa fa-cog"></i> Quản lý
                            </h3>
                            <ul>
                                <li>
                                    <a href="{{route('manage.article.edit', $article->id)}}">
                                        <i class="fa fa-edit"></i> Chỉnh sửa
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:" onclick="bootbox.deleteDialog({}, '{{route('manage.article.delete', $article->id)}}')">
                                        <i class="fa fa-trash"></i> Xoá bài
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endpermission
                </div>
            </div>
        </div>
    </div>
@endsection