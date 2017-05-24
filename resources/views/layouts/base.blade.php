<!DOCTYPE html>
<!--[if IE 8]>
<html lang="{{config('app.locale')}}" class="ie8 no-js">
<![endif]-->
<!--[if IE 9]>
<html lang="{{config('app.locale')}}" class="ie9 no-js">
<![endif]-->
<!--[if !IE]><!-->
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{config('app.keywords')}}"/>
    <meta name="author" content="{{config('app.author')}}"/>
    <meta name="copyright" content="{{config('app.copyright')}}"/>
    <meta name="description" content="@yield('description', config('app.description'))">
    <meta property="og:type" content="university"/>
    <meta property="og:site_name" content="{{config('app.name')}}"/>
    <meta property="og:title" content="@yield('title', config('app.name'))"/>
    <meta property="og:description" content="@yield('description', config('app.description'))"/>
    <meta property="og:url" content="{{Request::fullUrl()}}"/>
    <meta property="og:image" content="{{asset('img/SGUET.jpg')}}"/>

    <title>@yield('title', config('app.name'))</title>

    {{ Html::script('metronic/global/plugins/pace/pace.min.js') }}
    {{ Html::style('metronic/global/plugins/pace/themes/pace-theme-flash.css') }}

    {{ Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all') }}
    {{ Html::style('metronic/global/plugins/font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css') }}
    {{ Html::style('metronic/global/plugins/bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('metronic/global/plugins/uniform/css/uniform.default.css') }}
    {{ Html::style('metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}

    {{Html::style('metronic/global/plugins/bootstrap-toastr/toastr.min.css')}}
    @yield('page-level-plugins.styles')

    {{ Html::style('metronic/global/css/components-md.min.css', ['id' => 'style_components']) }}
    {{ Html::style('metronic/global/css/plugins-md.min.css') }}

    {{ Html::style('css/sguet/sguet.css') }}
    @yield('page-level-styles')

    {{ Html::style('metronic/layouts/layout/css/layout.min.css') }}
    {{ Html::style('metronic/layouts/layout/css/themes/darkblue.min.css', ['id' => 'style_color']) }}
    {{ Html::style('metronic/layouts/layout/css/custom.css') }}

    {{ Html::favicon('img/SGUET.png', ['type' => 'image/png']) }}
    <script>
        window.Laravel = {
            csrfToken: '{{csrf_token()}}',
            appUrl: '{{config('app.url')}}'
        };
    </script>
</head>
<body class="@yield('body-class', 'page-header-fixed page-container-bg-solid page-content-white page-md')">

@yield('body')

<!--[if lt IE 9]>
{{ Html::script('metronic/global/plugins/respond.min.js') }}
{{ Html::script('metronic/global/plugins/excanvas.min.js') }}
<![endif]-->

{{ Html::script('metronic/global/plugins/jquery.min.js') }}
{{ Html::script('metronic/global/plugins/bootstrap/js/bootstrap.min.js') }}
{{ Html::script('metronic/global/plugins/js.cookie.min.js') }}
{{ Html::script('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
{{ Html::script('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
{{ Html::script('metronic/global/plugins/jquery.blockui.min.js') }}
{{ Html::script('metronic/global/plugins/uniform/jquery.uniform.min.js') }}
{{ Html::script('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
{{ Html::script('js/jquery-cookie.js') }}

{{Html::script('metronic/global/plugins/bootstrap-toastr/toastr.min.js')}}
{{Html::script('metronic/global/plugins/bootbox/bootbox.min.js')}}
{{Html::script('metronic/global/plugins/jquery.pulsate.min.js')}}
@yield('page-level-plugins.scripts')

{{ Html::script('metronic/global/scripts/app.js') }}

{{ Html::script('js/sguet/sguet.js') }}
@include('vendor.flash.toastr')
@yield('page-level-scripts')

{{ Html::script('metronic/layouts/layout/scripts/layout.min.js') }}

</body>
</html>