<!-- BEGIN TOP NAVIGATION MENU -->
@if(Auth::check())
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user dropdown-dark last">
                <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true" style="height: 58px; padding-top: 20px; padding-left: 5px; padding-right: 5px;">
                    {!! Html::image('metronic/layouts/layout/img/avatar.png', '', ['class' => 'img-circle']) !!}
                    <span class="username username-hide-on-mobile">
                    {{Auth::user()->name}}
                </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    <li>
                        <a href="javascript:">
                            <i class="fa fa-user"></i> Hồ sơ cá nhân </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{!! route('auth.password.change.show') !!}">
                            <i class="fa fa-key"></i> Đổi mật khẩu
                        </a>
                    </li>
                    <li>
                        {!! Form::open(['method' => 'post', 'route' => ['logout'], 'id' => 'logout-form']) !!}
                        {!! Form::close() !!}
                        <a href="javascript:" onclick="logout()">
                            <i class="fa fa-sign-out"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
@endif
<!-- END TOP NAVIGATION MENU -->