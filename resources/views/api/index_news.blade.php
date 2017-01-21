<div class="cbp-loadMore-block{{$articles->currentPage()-1}}">
    @foreach($articles as $article)
        @include('api.news_item', ['article' => $article])
    @endforeach
</div>
@if($articles->nextPageUrl())
    <div class="cbp-loadMore-block{{$articles->currentPage()}}">
    </div>
@endif