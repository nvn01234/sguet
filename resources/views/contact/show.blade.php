@extends('layouts.search')

@section('title', $contact->getNameWithDescription())
@section('description', str_limit($contact->getOgDescription(), config('app.description.limit')))

@section('search-result-container')
    <div class="row margin-top-20" id="search-result-container">
        <div class="col-md-12">
            <div class="faq-page faq-content-1">
                <div class="faq-content-container">
                    <div class="faq-section ">
                        <h2 class="faq-title uppercase font-blue">
                            {{$contact->getNameWithDescription()}}
                        </h2>

                        <div class="panel-group accordion faq-content" id="faq-contents">
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true"></button>
                                Chưa hài lòng với kết quả tìm kiếm?
                                <a href="{{route('feedback.create', ['type' => 2])}}"
                                   class="alert-link"> Bấm vào đây </a> để gửi câu hỏi về cho chúng tôi,
                                hoặc <a href="{{route('contact.index')}}" class="alert-link">xem tất cả danh bạ</a>
                            </div>
                            @include('contact.detail')
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