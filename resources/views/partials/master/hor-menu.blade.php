<div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
    <ul class="nav navbar-nav">
        <li class="@activeroute('home')">
            <a href="{{route('home')}}"> Trang chủ
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('articles', 'articles.show')">
            <a href="{{route('articles')}}"> Tin tức - Hoạt động
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('contact.index')">
            <a href="{{route('contact.index')}}"> Danh bạ
                <span class="selected"> </span>
            </a>
        </li>
        <li class="last @activeroute('about')">
            <a href="{{route('about')}}"> Giới thiệu
                <span class="selected"> </span>
            </a>
        </li>
        <li class="last @activeroute('feedback.create')">
            <a href="{{route('feedback.create')}}"> Liên hệ
                <span class="selected"> </span>
            </a>
        </li>
    </ul>
</div>