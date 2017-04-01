@extends('layouts.single_portlet')

@section('page_level_styles')
    @parent
    {!! Html::style('metronic/pages/css/blog.min.css') !!}
@endsection

@section('icon', 'fa fa-newspaper-o')

@section('title', $article->title)

@section('portlet-body')
    <div class="blog-page blog-content-2">
        <div class="row">
            <div class="@if(Auth::check()) col-lg-9 @else col-lg-12 @endif">
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
                            @foreach($article->tags as $tag)
                                <li class="uppercase">
                                    <a href="javascript:;">{{$tag->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @if(Auth::check())
                <div class="col-lg-3">
                    <div class="blog-single-sidebar bordered blog-container">
                        <div class="blog-single-sidebar-tags">
                            <h3 class="blog-sidebar-title uppercase">Nhãn</h3>
                            <ul class="blog-post-tags">
                                @foreach($article->tags as $tag)
                                    <li class="uppercase">
                                        <a href="javascript:;">{{$tag->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
                                    <a href="{{route('manage.article.delete', $article->id)}}">
                                        <i class="fa fa-trash"></i> Xoá bài
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection