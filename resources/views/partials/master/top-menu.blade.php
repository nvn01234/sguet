<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user dropdown-dark">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
               data-close-others="true">
                <img alt="" class="img-circle" src="{{asset('img/SGUET.jpg')}}">
                <span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                <li>
                    <a href="javascript:">
                        <i class="fa fa-user"></i> Hồ sơ cá nhân
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="{{route('auth.password.change.show')}}">
                        <i class="fa fa-key"></i> Đổi mật khẩu </a>
                </li>
                <li>
                    <a href="javascript:" onclick="document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i> Đăng xuất
                    </a>
                    {{Form::open(['method' => 'post', 'route' => 'logout', 'id' => 'logout-form'])}}
                    {{Form::close()}}
                </li>
            </ul>
        </li>
    </ul>
</div>