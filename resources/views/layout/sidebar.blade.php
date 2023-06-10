<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{request()->segment(1) == "" ? "" : "collapsed"}}" href="{{route('dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.main.category') ? "" : "collapsed"}}" href="{{route('admin.main.category')}}">
                <i class="bi bi-grid"></i>
                <span>Main Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.sub.category') ? "" : "collapsed"}}" href="{{route('admin.sub.category')}}">
                <i class="bi bi-grid"></i>
                <span>Sub Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.film.industry') ? "" : "collapsed"}}" href="{{route('admin.film.industry')}}">
                <i class="bi bi-grid"></i>
                <span>Film Industry</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.home.category') ? "" : "collapsed"}}" href="{{route('admin.home.category')}}">
                <i class="bi bi-grid"></i>
                <span>Home Category</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.home.category.visibility') ? "" : "collapsed"}}" href="{{route('admin.home.category.visibility')}}">
                <i class="bi bi-grid"></i>
                <span>Home Category Trending</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.feature.movie') ? "" : "collapsed"}}" href="{{route('admin.feature.movie')}}">
                <i class="bi bi-grid"></i>
                <span>Feature Movies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.movie') ? "" : "collapsed"}}" href="{{route('admin.movie')}}">
                <i class="bi bi-grid"></i>
                <span>Movies</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.movie.part') ? "" : "collapsed"}}" href="{{route('admin.movie.part')}}">
                <i class="bi bi-grid"></i>
                <span>Movies Part</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.subscription') ? "" : "collapsed"}}" href="{{route('admin.subscription')}}">
                <i class="bi bi-grid"></i>
                <span>Subscription Plan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('admin.subscription.coupon') ? "" : "collapsed"}}" href="{{route('admin.subscription.coupon')}}">
                <i class="bi bi-grid"></i>
                <span>Subscription Coupon</span>
            </a>
        </li>


       {{-- <li class="nav-item">
            <a class="nav-link {{request()->segment(1) == "employee" ? "" : "collapsed"}}" data-bs-target="#employee-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Employee</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="employee-nav" class="nav-content collapse {{request()->segment(1) == "employee" ? "show" : ""}}" data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{request()->segment(1) == "employee" && request()->segment(2) == "list" ? "active" : ""}}" href="{{route('employee.list')}}">
                        <i class="bi bi-circle"></i><span>List</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-circle"></i><span>Salary</span>
                    </a>
                </li>

            </ul>
        </li>--}}
        <!-- End Components Nav -->
    </ul>
</aside>
