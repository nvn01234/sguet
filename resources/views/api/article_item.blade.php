<div class="cbp-item category-{{$article->category_id}} @foreach($article->tags as $tag) tag-{{$tag->id}} @endforeach">
    <div class="cbp-caption">
        <div class="cbp-caption-defaultWrap">
            @if($article->image_url)
                <img src="{{$article->image_url}}" style="height: 100%" alt=""/>
            @else
                {!! Html::image('img/no-image.png') !!}
            @endif
        </div>
        <div class="cbp-caption-activeWrap">
            <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                    <a href="{!! URL::route('articles.slug', $article->slug) !!}" rel="nofollow"
                       class="cbp-l-caption-buttonLeft btn btn-primary uppercase">chi tiết</a>
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