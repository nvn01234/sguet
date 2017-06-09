@extends('layouts.search')

@section('title', $faq->question)
@section('description', str_limit($faq->question . " - " . trim(strip_tags($faq->answer)), config('app.description.limit')))

@section('search-result-container')
    <div class="row margin-top-20" id="search-result-container">
        <div class="col-md-12">
            <div class="faq-page faq-content-1">
                <div class="faq-content-container">
                    <div class="faq-section ">
                        <h2 class="faq-title uppercase font-blue">
                            {{$faq->question}}
                        </h2>

                        <div class="panel-group accordion faq-content" id="faq-contents">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true"></button>
                                Chưa hài lòng với kết quả tìm kiếm?
                                <a href="{{route('feedback.create', ['type' => 2])}}"
                                   class="alert-link"> Bấm vào đây </a> để gửi câu hỏi về cho chúng tôi!
                            </div>
                            <div class="panel-footer bg-white">
                                @include('partials.faq.action')
                            </div>
                            {!! $faq->answer !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-level-scripts')
    @parent
    <script>
        $(function() {
            App.scrollTo($('#search-result-container'), 1);
        });
    </script>
@endsection