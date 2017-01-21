<div class="blog-page blog-content-2">
    <div class="row">
        <div class="col-lg-12">
            <div class="blog-single-content bordered blog-container">
                <div class="blog-single-head">
                    <h1 class="blog-single-head-title">{{$article->title}}</h1>
                    <div class="blog-single-head-date">
                        <i class="icon-calendar font-blue"></i>
                        <a href="javascript:">{{$article->created_at}}</a>
                    </div>
                </div>
                <div class="blog-single-img" id="blog-single-img">
                    <script>
                        loadImgAsync('{!! $article->image_url !!}', $('#blog-single-img'), {append: true})
                    </script>
                </div>
                <div class="blog-single-desc">
                    {!! $article->body !!}
                </div>
                <div class="blog-single-foot">
                    <ul class="blog-post-tags">
                        @foreach($article->tags as $tag)
                            <li class="uppercase">
                                <a href="javascript:">{{$tag->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>