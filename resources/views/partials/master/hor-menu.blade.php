<div class="hor-menu  hor-menu-light hidden-sm hidden-xs">
    <ul class="nav navbar-nav">
        <li class="@activeroute('home', 'faq.slug', 'contact.slug')">
            <a href="{{route('home')}}" class="visible-md only-icon"> <i class="fa fa-home"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('home')}}" class="hidden-md"> Trang chủ
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('articles', 'articles.show')">
            <a href="{{route('articles')}}" class="visible-md only-icon"> <i class="fa fa-newspaper-o"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('articles')}}" class="hidden-md"> Tin tức - Hoạt động
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('contact.index')">
            <a href="{{route('contact.index')}}" class="visible-md only-icon"> <i class="fa fa-address-book"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('contact.index')}}" class="hidden-md"> Danh bạ
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('about')">
            <a href="{{route('about')}}" class="visible-md only-icon"> <i class="fa fa-info-circle"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('about')}}" class="hidden-md"> Giới thiệu
                <span class="selected"> </span>
            </a>
        </li>
        <li class="@activeroute('feedback.create')">
            <a href="{{route('feedback.create')}}" class="visible-md only-icon"> <i class="fa fa-phone"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('feedback.create')}}" class="hidden-md"> Liên hệ
                <span class="selected"> </span>
            </a>
        </li>
        <li class="last @activeroute('links')">
            <a href="{{route('links')}}" class="visible-md only-icon"> <i class="fa fa-link"></i>
                <span class="selected"> </span>
            </a>
            <a href="{{route('links')}}" class="hidden-md"> Links
                <span class="selected"> </span>
            </a>
        </li>
    </ul>
</div>