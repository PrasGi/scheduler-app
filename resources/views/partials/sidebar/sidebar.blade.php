<!-- ======= Sidebar ======= -->
@php
    $route = Request::route()->getName();
@endphp

<aside id="sidebar" class="sidebar shadow">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ $route == 'dashboard' ? 'active' : '' }} collapsed" href="{{ route('dashboard') }}">
                <i class="bi bi-house"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">action</li>

        <li class="nav-item">
            <a class="nav-link {{ $route == 'schedule.index' ? 'active' : '' }} collapsed"
                href="{{ route('schedule.index') }}">
                <i class="bi bi-archive"></i>
                <span>Schedule</span>
            </a>
        </li>

        @if (auth()->user()->role->name == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.index' ? 'active' : '' }} collapsed"
                    href="{{ route('user.index') }}">
                    <i class="bi bi-person"></i>
                    <span>User</span>
                </a>
            </li>
        @endif
    </ul>

</aside><!-- End Sidebar-->
