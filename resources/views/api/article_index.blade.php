<div class="cbp-loadMore-block{{$articles->currentPage()-1}}">
    @foreach($articles as $article)
        @include('api.article_item')
    @endforeach
</div>
@if($articles->nextPageUrl())
    <div class="cbp-loadMore-block{{$articles->currentPage()}}">
    </div>
@endif