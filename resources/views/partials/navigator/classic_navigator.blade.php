<li class="@hasSection('mobile') nav-item @endif @yield('menu.' . $route)">
    <a href="{!! URL::route($route) !!}" @hasSection('mobile') class="nav-link nav-toggle"
       @else data-hover="megamenu-dropdown" data-close-other="true" @endif>
        {{$name}}
        @hasSection('mobile') @else <span class="@hasSection('menu.' . $route) selected @endif"> </span> @endif
    </a>
</li>