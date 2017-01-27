<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user">
            <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
               data-close-others="true">
                {!! Html::image('img/SGUET.jpg', '', ['class' => 'img-circle']) !!}
                <span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-default">
                {{--<li>--}}
                {{--<a href="page_user_profile_1.html">--}}
                {{--<i class="icon-user"></i> My Profile </a>--}}
                {{--</li>--}}
                <li class="divider"></li>
                <li>
                    <script>
                        function logout() {
                            $('#logout-form').submit();
                        }
                    </script>
                    <a href="javascript:" onclick="logout()">
                        <i class="icon-key"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
    {!! Form::open(['method' => 'post', 'route' => ['logout'], 'id' => 'logout-form']) !!}
    {!! Form::close() !!}
</div>
<!-- END TOP NAVIGATION MENU -->