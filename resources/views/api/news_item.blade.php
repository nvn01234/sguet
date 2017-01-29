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
                    <a href="{!! URL::route('api.news.show', ['id' => $article->id]) !!}" rel="nofollow"
                       class="cbp-singlePage cbp-l-caption-buttonLeft btn primary uppercase">chi tiết</a>
                </div>
            </div>
        </div>
    </div>
    <div class="cbp-l-grid-projects-title uppercase text-center">{{$article->title}}</div>
    <div class="cbp-l-grid-projects-desc uppercase text-center">
        @if($article->short_description && !empty(trim($article->short_description)))
            @php(Debugbar::addMessage($article->short_description, 'case 1'))
            {{$article->short_description}}
        @else
            @php
                $body = strip_tags($article->body);
                $a = ["\t", "\n", "\r", "&nbsp;"];
                $body = str_replace($a, " ", $body);
                $body = preg_replace('# {2,}#', ' ', $body);
                $body = trim($body);
                $short_description = substr($body, 0, 100);
                echo empty($short_description) ? Html::nbsp() : $short_description;
            @endphp
        @endif
    </div>
</div>