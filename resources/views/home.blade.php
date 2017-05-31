@extends('layouts.page')

@section('page-level-styles')
    @parent
    {{ Html::style('css/sguet/cover-image.css') }}
    {{ Html::style('metronic/pages/css/faq.min.css') }}
    <style>
        .no-boder-radius {
            border-radius: 0 !important;
        }

        .sg-header > div {
            margin: calc((170px - 97px) / 2) 0;
        }

        .sg-header h1 {
            font-size: 50px;
            font-weight: 600;
            text-shadow: 1px 1px 0 rgba(0, 0, 0, .2);
        }

        .sg-header h2 {
            font-size: 20px;
            font-weight: 400;
        }

        .vertical-center {
            margin-top: calc(
                    (100vh
                    - (58px + 33px)/* header + footer */
                    - 236px/* container */
                    - (170px + 20px)/* sg-header */) / 2
                    - 25px /* padding-top */
            );
        }
    </style>
@endsection

@section('page-body')
    <div class="container vertical-center">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
                <div class="row row-eq-height">
                    <div class="col-md-3 col-sm-3 hidden-xs">
                        <img src="{{asset('img/SGUET.png')}}" alt="SGUET" style="width: 100%">
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12 font-white text-center sg-header">
                        <div>
                            <h1>Support Group UET</h1>
                            <h2>CLB HỖ TRỢ SINH VIÊN TRƯỜNG ĐH CÔNG NGHỆ</h2>
                        </div>
                    </div>
                </div>
                <div class="row margin-top-20">
                    <div class="col-md-12">
                        {{Form::open(['method' => 'get', 'route' => 'home','id' => 'search-form'])}}
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control no-boder-radius" placeholder="Nhập câu hỏi..."
                                   autofocus required name="query" value="{{$request->get('query')}}">
                            <span class="input-group-btn">
                                <button class="btn green-soft uppercase bold no-boder-radius" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {{Form::close()}}
                    </div>
                </div>
                <div class="row margin-top-20" id="search-result-container" style="display: none">
                    <div class="col-md-12">
                        <div class="faq-page faq-content-1">
                            <div class="faq-content-container">
                                <div class="faq-section ">
                                    <h2 class="faq-title uppercase font-blue">
                                        <span></span> kết quả
                                    </h2>
                                    <div class="panel-group accordion faq-content" id="search-result">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="result-html" hidden>
        @include('partials.home.result')
    </div>
@endsection

@section('page-level-scripts')
    @parent
    <script>
        $(function () {
            var form = $('#search-form');
            var result_html = getHtmlAndRemove('result-html');

            form.submit(function (e) {
                e.preventDefault();
                var loading = bootbox.loading({message: 'Đang tìm kiếm'});
                window.history.pushState({}, '{{config('app.name')}}', '{{route('home')}}?' + $(this).serialize());
                $.ajax({
                    method: 'get',
                    url: '{{route('api.faq.search')}}',
                    data: $(this).serialize()
                }).done(function(response) {
                    var container = $('#search-result-container');
                    container.slideDown();
                    App.scrollTo(container, 1);
                    container.find('.faq-title > span').text(response.length);

                    var results = $('#search-result');
                    results.empty();
                    if (response.length === 0) {
                        results.text('Chúng tôi không tìm thấy câu trả lời cho câu hỏi bạn cần tìm. Câu hỏi của bạn đã được ghi lại và sẽ được cập nhật. Vui lòng quay lại sau.');
                    } else {
                        response.forEach(function(result) {
                            var result_el = $(result_html);
                            result_el.find('.accordion-toggle')
                                .attr('href', '#collapse_' + result.id)
                                .text(result.question);
                            result_el.find('.panel-collapse')
                                .attr('id', 'collapse_' + result.id);
                            result_el.find('.panel-body')
                                .html(result.answer);

                            @permission('manage-content')
                                result_el.find('.panel-footer').show();
                                result_el.find('.edit-btn')
                                    .attr('href', '{{route('manage.faq.edit', '_ID_')}}'.replace('_ID_', result.id));
                                result_el.find('.delete-btn')
                                    .attr('href', '{{route('manage.faq.delete', '_ID_')}}'.replace('_ID_', result.id));
                            @endpermission

                            results.append(result_el);
                        })
                    }

                    loading.modal('hide');
                })
            });

            @if($request->has('query'))
                form.submit();
            @endif
        });
    </script>
@endsection