<!DOCTYPE html>
<!--[if IE 8]>
<html lang="vi" class="ie8 no-js">
<![endif]-->
<!--[if IE 9]>
<html lang="vi" class="ie9 no-js">
<![endif]-->
<!--[if !IE]><!-->
<html lang="vi">
<head>
    @section('meta')
        {!! Html::meta(null, null, ['charset' => 'utf-8']) !!}
        {!! Html::meta(null, 'IE=edge', ['http-equiv' => 'X-UA-Compatible']) !!}
        {!! Html::meta('viewport', 'width=device-width, initial-scale=1') !!}
        {!! Html::meta('description', 'Website chính thức của SGUET') !!}
        {!! Html::meta('abstract', 'Câu lạc bộ Hỗ trợ sinh viên Trường Đại học Công Nghệ, Đại học Quốc Gia') !!}
        {!! Html::meta('keywords', 'SGUET, Câu lạc bộ Hỗ trợ sinh viên') !!}
        {!! Html::meta('rights', 'SGUET') !!}
    @show

    <title>@yield('title', 'SGUET - CLB Hỗ trợ sinh viên Trường Đại học Công nghệ')</title>

    @section('page_first_scripts')
        {!! Html::script('metronic/global/plugins/pace/pace.min.js') !!}
    @show

    @section('page_top_styles')
        {!! Html::style('metronic/global/plugins/pace/themes/pace-theme-flash.css') !!}
    @show

    @section('global_mandatory_styles')
        {!! Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all') !!}
        {!! Html::style('metronic/global/plugins/font-awesome/css/font-awesome.min.css') !!}
        {!! Html::style('metronic/global/plugins/simple-line-icons/simple-line-icons.min.css') !!}
        {!! Html::style('metronic/global/plugins/bootstrap/css/bootstrap.min.css') !!}
        {!! Html::style('metronic/global/plugins/uniform/css/uniform.default.css') !!}
        {!! Html::style('metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}
    @show

    @yield('page_level_plugins.styles')

    @section('theme_global_styles')
        {!! Html::style('metronic/global/css/components-md.min.css', ['id' => 'style_components']) !!}
        {!! Html::style('metronic/global/css/plugins-md.min.css') !!}
    @show

    @yield('page_level_styles')

    @section('theme_layout_styles')
        {!! Html::style('metronic/layouts/layout/css/layout-custom.css') !!}
        {!! Html::style('metronic/layouts/layout/css/themes/sguet.css', ['id' => 'style_color']) !!}
    @show

    @yield('styles')

    @section('scripts.top')
        {!! Html::script('metronic/global/plugins/jquery.min.js') !!}
    @show

    {!! Html::favicon('img/SGUET.png', ['type' => 'image/png']) !!}
</head>
<body class="@yield('body.class')">

@yield('body.inner')

<!--[if lt IE 9]>
{!! Html::script('metronic/global/plugins/respond.min.js') !!}
{!! Html::script('metronic/global/plugins/excanvas.min.js') !!}
<![endif]-->

@section('core_plugins')
    {!! Html::script('metronic/global/plugins/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('metronic/global/plugins/js.cookie.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
    {!! Html::script('metronic/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
    {!! Html::script('metronic/global/plugins/jquery.blockui.min.js') !!}
    {!! Html::script('metronic/global/plugins/uniform/jquery.uniform.min.js') !!}
    {!! Html::script('metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}
@show

@yield('page_level_plugins.scripts')

@section('theme_global_scripts')
    {!! Html::script('metronic/global/scripts/app.js') !!}
    <script>
        App.setAssetsPath('/metronic/')
    </script>
@show

@yield('page_level_scripts')

@section('theme_layout_scripts')
    {!! Html::script('metronic/layouts/layout/scripts/layout.min.js') !!}
    {{--    {!! Html::script('metronic/layouts/global/scripts/quick-sidebar.min.js') !!}--}}
@show

@yield('scripts')

</body>
</html>