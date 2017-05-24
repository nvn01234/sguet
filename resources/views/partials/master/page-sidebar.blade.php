<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        @if(Auth::check())
            @include('partials.master.page-sidebar-desktop')
        @endif
        @include('partials.master.page-sidebar-mobile')
    </div>
</div>