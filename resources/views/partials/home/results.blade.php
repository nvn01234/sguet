<div class="col-md-12">
    <div class="faq-page faq-content-1">
        <div class="faq-content-container">
            <div class="faq-section ">
                <h2 class="faq-title uppercase font-blue">
                    {{$faqs->count()}} kết quả
                </h2>
                <div class="panel-group accordion faq-content" id="search-result">
                    @if($faqs->isNotEmpty())
                        @foreach($faqs as $faq)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <i class="fa fa-question"></i>
                                        <a class="accordion-toggle" data-toggle="collapse"
                                           data-parent="#search-result" href="#collapse_{{$faq->id}}">
                                            {{$faq->question}}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse_{{$faq->id}}" class="panel-collapse collapse">
                                    @permission('manage-content')
                                    <div class="panel-footer bg-white">
                                        <a href="{{route('manage.faq.edit', $faq->id)}}"
                                           class="btn btn-sm green edit-btn">
                                            <i class="fa fa-edit"></i>Sửa
                                        </a>
                                        <a href="{{route('manage.faq.delete', $faq->id)}}"
                                           class="btn btn-sm red delete-btn">
                                            <i class="fa fa-trash-o"></i> Xoá
                                        </a>
                                    </div>
                                    @endpermission
                                    <div class="panel-body">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        Chúng tôi không tìm thấy câu trả lời cho câu hỏi bạn cần tìm.
                        <br>Bạn có muốn {{Html::link(route('feedback.create', ['type' => 2, 'message' => request('query')]), 'gửi câu hỏi này')}} cho chúng tôi?
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>