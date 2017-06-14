@extends('layouts.page')

@section('page-level-styles')
    @parent
    {{ Html::style('metronic/pages/css/about.min.css') }}
    <style>
        .sguet-logo {
            content: url("{{asset('img/SGUET.png')}}");
            padding: 20px 20px !important;
            height: 106px;
            width: 106px;
        }
    </style>
@endsection

@section('title', 'Giới thiệu về SGUET')

@section('page-breadcrumb')
    <li>
        <a href="{{route('home')}}">
            Trang chủ
        </a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li>
        <span>Giới thiệu</span>
    </li>
@endsection

@section('page-title', 'Giới thiệu về SGUET')
@section('page-description', 'Support Group University of Engineering and Technology')

@section('page-body')
    <div class="row margin-bottom-20 row-eq-height">
        <div class="col-lg-3 col-md-6">
            <div class="portlet light">
                <div class="card-icon">
                    <i class="sguet-logo font-red-sunglo theme-font"></i>
                </div>
                <div class="card-title">
                    <span>Tên đầy đủ</span>
                </div>
                <div class="card-desc">
                    <span>
                        Câu lạc bộ Hỗ trợ sinh viên<br/>
                        Trường Đại học Công nghệ<br/>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="portlet light">
                <div class="card-icon">
                    <i class="icon-calendar font-green-haze theme-font"></i>
                </div>
                <div class="card-title">
                    <span>Ngày thành lập</span>
                </div>
                <div class="card-desc">
                        <span>
                            14/11/2012<br/>
                            &nbsp;<br/>
                        </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="portlet light">
                <div class="card-icon">
                    <i class="fa fa-globe font-purple-wisteria theme-font"></i>
                </div>
                <div class="card-title">
                    <span>Các kênh</span>
                </div>
                <div class="card-desc">
                        <span>
                            <i class="fa fa-facebook-official"></i> <a href="https://www.facebook.com/SupportGroupUET"
                                                                       target="_blank">SupportGroupUET</a><br>
                            <i class="fa fa-youtube-play"></i> <a href="https://www.youtube.com/sguetchannel"> sguetchannel </a>
                        </span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="portlet light">
                <div class="card-icon">
                    <i class="icon-call-end font-blue theme-font"></i>
                </div>
                <div class="card-title">
                    <span>Liên hệ</span>
                </div>
                <div class="card-desc">
                    <span>
                        <i class="fa fa-envelope"></i> {{Html::mailto('lienhe.sguet@gmail.com')}}<br/>
                        <i class="fa fa-comments"></i> <a href="{{route('feedback.create')}}">Để lại tin nhắn</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-eq-height margin-bottom-40">
        <div class="col-lg-6">
            <div class="portlet light about-text">
                <h4>
                    <i class="fa fa-trophy"></i> Nhiệm vụ</h4>
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="list-unstyled margin-top-10 margin-bottom-10">
                            <li>
                                <i class="fa fa-check"></i>
                                Hỗ trợ và giúp đỡ sinh viên UET hiểu biết về trường và các hoạt động học tập, phong trào đoàn thể của nhà trường. (Mục đích chính).
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                Hỗ trợ và phát triển các hoạt động của Đoàn TN- Hội SV trường.
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                Quảng bá hình ảnh UET.
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                Tạo môi trường mới đầy đam mê, nhiệt huyết và chuyên nghiệp cho sinh viên trường Đại học Công nghệ.
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                Xây dựng SGUET trở thành một kênh truyền bá thông tin chính thức và đáng tin cậy của sinh viên Đại học Công nghệ - ĐHQGHN.
                            </li>
                            <li>
                                <i class="fa fa-check"></i>
                                Xây dựng SGUET trở thành một kênh truyền thông phản ánh đời sống và nguyện vọng của sv công nghệ
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/uwNPxjqX0UY" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection