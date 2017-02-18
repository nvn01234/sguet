<!-- BEGIN TOP NAVIGATION MENU -->
@if(Auth::check())
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            <li class="dropdown dropdown-user">
                <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                   data-close-others="true">
                    {!! Html::image('img/SGUET.jpg', '', ['class' => 'img-circle']) !!}
                    <span class="username username-hide-on-mobile">
                    @if(Auth::check())
                            {{Auth::user()->name}}
                        @else
                            Khách
                        @endif
                </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    @if (Auth::check())
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
                    @else
                        <li>
                            <a href="{!! route('login') !!}">
                                <i class="fa fa-sign-in"></i> Đăng nhập
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
    </div>
@endif
<!-- END TOP NAVIGATION MENU -->