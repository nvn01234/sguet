<div class="cbp-item category-{{$article->category_id}}">
    <div class="cbp-caption">
        <div class="cbp-caption-defaultWrap">
            {!! Html::image('img/SGUET.jpg', null, ['id' => 'img-'.$article->id]) !!}
            @if($article->image_url)
                <script async>
                    loadImgAsync('{{$article->image_url}}', $('#img-{{$article->id}}'));
                </script>
            @endif
        </div>
        <div class="cbp-caption-activeWrap">
            <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                    <a href="{!! URL::route('api.article.show', ['id' => $article->id]) !!}" rel="nofollow"
                       class="cbp-singlePage cbp-l-caption-buttonLeft btn primary uppercase">chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    <div class="cbp-l-grid-projects-title uppercase text-center">{{$article->title}}</div>
    <div class="cbp-l-grid-projects-desc uppercase text-center">
        @if(empty(trim($article->short_description)))
            {!! Html::nbsp() !!}
        @else
            {{$article->short_description}}
        @endif
    </div>
</div>