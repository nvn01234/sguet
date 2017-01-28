@if($visible)
    <li class="@hasSection('mobile') nav-item @hasSection('menu.' . $route) open @endif @else classic-menu-dropdown @endif @yield('menu.' . $route)">
        <a href="javascript:" @hasSection('mobile') class="nav-link nav-toggle" @else data-hover="megamenu-dropdown"
           data-close-other="true" @endif>
            {{$name}}
            @hasSection('mobile')
                <span class="arrow @hasSection('menu.' . $route) open @endif"></span>
            @else
                <i class="fa fa-angle-down"></i>
                <span class="@hasSection('menu.' . $route) selected @endif"> </span>
            @endif
        </a>
        <ul class="@hasSection('mobile') sub-menu @else dropdown-menu pull-left @endif">
            @foreach($items as $item)
                <li class="@hasSection('mobile') nav-item @endif @yield('menu.' . $route . '.' . $item['route'])">
                    <a href="{!! URL::route($route . '.' . $item['route']) !!}"
                       @hasSection('mobile') class="nav-link" @endif>
                        @if($item['icon']) <i class="fa {{$item['icon']}}"></i> @endif
                        {{$item['name']}}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
@endif