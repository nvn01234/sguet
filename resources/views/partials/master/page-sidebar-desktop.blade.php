<ul class="page-sidebar-menu  page-header-fixed hidden-sm hidden-xs" data-keep-expanded="false" data-auto-scroll="true"
    data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper ">
        <div class="sidebar-toggler" id="siderbar-toggler"></div>
    </li>
    <li class="heading">
        <h3 class="uppercase">Quản lý</h3>
    </li>
    @role('admin')
    <li class="nav-item @activeroute('manage.user.create', 'manage.user', 'manage.user.edit')">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Người dùng</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item @activeroute('manage.user.create')">
                <a href="{{route('manage.user.create')}}" class="nav-link ">
                    <span class="title">Thêm người dùng</span>
                </a>
            </li>
            <li class="nav-item @activeroute('manage.user')">
                <a href="{{route('manage.user')}}" class="nav-link ">
                    <span class="title">Danh sách người dùng</span>
                </a>
            </li>
        </ul>
    </li>
    @endrole
    <li class="nav-item @activeroute('manage.faq.create', 'manage.faq', 'manage.faq.edit')">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-question"></i>
            <span class="title">UET Q&A</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item @activeroute('manage.faq.create')">
                <a href="{{route('manage.faq.create')}}" class="nav-link ">
                    <span class="title">Thêm Q&A</span>
                </a>
            </li>
            <li class="nav-item @activeroute('manage.faq')">
                <a href="{{route('manage.faq')}}" class="nav-link ">
                    <span class="title">Danh sách Q&A</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  @activeroute('manage.article.create', 'manage.article', 'manage.article.edit')">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-newspaper-o"></i>
            <span class="title">Tin tức - hoạt động</span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @activeroute('manage.article.create')">
                <a href="{{route('manage.article.create')}}" class="nav-link ">
                    <span class="title">Đăng bài</span>
                </a>
            </li>
            <li class="nav-item  @activeroute('manage.article')">
                <a href="{{route('manage.article')}}" class="nav-link ">
                    <span class="title">Danh sách bài đăng</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  @activeroute('manage.contact')">
        <a href="{{route('manage.contact')}}" class="nav-link nav-toggle">
            <i class="fa fa-address-book"></i>
            <span class="title">Danh bạ</span>
        </a>
    </li>
    <li class="nav-item  @activeroute('manage.search_log')">
        <a href="{{route('manage.search_log')}}" class="nav-link nav-toggle">
            <i class="fa fa-history"></i>
            <span class="title">Lịch sử tìm kiếm</span>
        </a>
    </li>
    @role('admin')
    <li class="nav-item  @activeroute('manage.backup')">
        <a href="{{route('manage.backup')}}" class="nav-link nav-toggle">
            <i class="fa fa-database"></i>
            <span class="title">Sao lưu CSDL</span>
        </a>
    </li>
    @endrole
</ul>