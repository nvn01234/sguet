<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{!! URL::route('home') !!}">
                {!! Html::image('img/SGUET.png', 'logo', ['class' => 'logo-default', 'width' => '30px', 'height' => 'auto', 'style' => 'margin-top: 8px']) !!}
            </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
        <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
        <div class="hor-menu   hidden-sm hidden-xs">
            <ul class="nav navbar-nav">
                <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                @include('partials.navigators')
            </ul>
        </div>
        <!-- END MEGA MENU -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->