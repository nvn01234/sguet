<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        @permission('manage-content')
            @include('partials.master.page-sidebar-desktop')
        @endpermission
        @include('partials.master.page-sidebar-mobile')
    </div>
</div>