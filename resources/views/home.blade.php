@extends('layouts.search')

@section('search-result-container')
    <div class="row margin-top-20" id="search-result-container" @if(!isset($faqs))style="display: none"@endif>
        @if(isset($faqs))
            @include('partials.home.results')
        @endif
    </div>
@endsection

@section('page-level-scripts')
    @parent
    @if(isset($faqs))
        <script>
            $(function() {
                App.scrollTo($('#search-result-container'), 1);
            });
        </script>
    @endif
@endsection