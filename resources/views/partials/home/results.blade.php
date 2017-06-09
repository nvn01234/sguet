<div class="col-md-12">
    <div class="tabbable-custom nav-justified bg-white">
        <ul class="nav nav-tabs nav-justified">
            <li class="active">
                <a href="#faq-result" data-toggle="tab"> UET Q&A </a>
            </li>
            <li>
                <a href="#contact-result" data-toggle="tab"> Danh bạ </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="faq-result">
                <div class="faq-page faq-content-1">
                    <div class="faq-content-container">
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">
                                {{$faqs->count()}} kết quả
                            </h2>

                            <div class="panel-group accordion faq-content" id="faq-contents">
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true"></button>
                                    Chưa hài lòng với kết quả tìm kiếm?
                                    <a href="{{route('feedback.create', ['type' => 2, 'message' => request('query')])}}"
                                       class="alert-link"> Bấm vào đây </a> để gửi câu hỏi về cho chúng tôi!
                                </div>
                                @foreach($faqs as $faq)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-question"></i>
                                                <a class="accordion-toggle" data-toggle="collapse"
                                                   data-parent="#faq-contents" href="#collapse_faq_{{$faq->id}}">
                                                    {{$faq->question}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_faq_{{$faq->id}}" class="panel-collapse collapse">
                                            <div class="panel-footer bg-white">
                                            @include('partials.faq.action')
                                            </div>
                                            <div class="panel-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact-result">
                <div class="faq-page faq-content-1">
                    <div class="faq-content-container">
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">
                                {{$contacts->count()}} kết quả
                            </h2>
                            <div class="panel-group accordion faq-content" id="contact-contents">
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true"></button>
                                    Chưa hài lòng với kết quả tìm kiếm?
                                    <a href="{{route('feedback.create', ['type' => 2, 'message' => request('query')])}}"
                                       class="alert-link"> Bấm vào đây </a> để gửi câu hỏi về cho chúng tôi,
                                    hoặc <a href="{{route('contact.index')}}" class="alert-link">xem tất cả danh bạ</a>
                                </div>

                                @foreach($contacts as $contact)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <i class="fa fa-phone"></i>
                                                <a class="accordion-toggle" data-toggle="collapse"
                                                   data-parent="#contact-contents"
                                                   href="#collapse_contact_{{$contact->id}}">
                                                    {{$contact->getNameWithDescription()}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse_contact_{{$contact->id}}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                @include('contact.detail')
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>