@extends('layouts.base')

@section('body-class', 'page-404-3')

@section('page-level-styles')
    @parent
    {!! Html::style('metronic/pages/css/error.min.css') !!}
@endsection

@section('body')
    <div class="page-inner">
        <img src="{{asset('metronic/pages/media/pages/earth.jpg')}}" class="img-responsive" alt=""></div>
    <div class="container error-404">
        <h1>404</h1>
        <h2>Người nhà đang tìm bạn!</h2>
        <p> Có vẻ như bạn đang đi lạc. Hãy quay trở về Trái Đất ngay. </p>
        <p>
            <a href="javascript:" class="btn red btn-outline" id="continue"> <i class="fa fa-arrow-left"></i> Đi tiếp </a>
            <a href="javascript:" class="btn green" id="back"> Trở về Trái Đất <i class="fa fa-arrow-right"></i> </a>
            <i class="fa fa-fighter-jet font-green" style="display: none" id="plane"></i>
        </p>
    </div>
@endsection

@section('page-level-scripts')
    @parent
    <script>
        $(function() {
            var left = '50%';

            $('#back').click(function() {
                var plane = $('#plane');
                plane.fadeIn(function() {
                    plane.animate({
                        'margin-left': left
                    }, 1000, function() {
                        window.location = '{{route('home')}}';
                    })
                });
            });

            $('#continue').mouseover(function() {
                $(this).hide();
                left = "60%";
                toastr['info']('Bạn chỉ có duy nhất 1 sự lựa chọn!', '');
            });
        });
    </script>
@endsection