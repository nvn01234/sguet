<li class="@hasSection('mobile') nav-item @endif @yield('menu.' . $route)">
    <a href="{!! URL::route($route) !!}" class="@hasSection('mobile') nav-link nav-toggle @endif"
       data-hover="megamenu-dropdown" data-close-other="true">
        {{$name}}
        <span class="@hasSection('menu.' . $route) selected @endif"> </span>
    </a>
</li>