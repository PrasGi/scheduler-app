<!-- ======= Header ======= -->
@php
    $route = Request::route()->getName();

    $itemSearch = ['schedule.index', 'user.index'];
@endphp

<header id="header" class="header fixed-top d-flex align-items-center shadow">

    <div class="d-flex align-items-center justify-content-between">
        <i class="bi bi-list toggle-sidebar-btn"></i>
        <a href="#" class="logo d-flex align-items-center">
            <span class="d-none d-lg-block fs-3 ms-3">Scheduler</span>
        </a>
    </div><!-- End Logo -->

    @if (in_array($route, $itemSearch))
        <div class="search-bar">
            <form id="search-form" class="search-form d-flex align-items-center d-flex gap-2" method="get"
                action="{{ route($route) }}">
                @if ($route == 'schedule.index')
                    <input id="date-input" type="date" name="date" class="form-control">
                @endif
                <input type="text" name="search" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->
    @endif

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

                @php
                    $deadlineSchedules = auth()->user()->deadlineSchedules;
                    $notifications = $deadlineSchedules->count();
                @endphp

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    @if ($notifications > 0)
                        <span class="badge bg-primary badge-number">{{ $notifications }}</span>
                    @endif
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        Your storage notifications
                    </li>

                    @if ($notifications > 0)
                        @foreach ($deadlineSchedules as $dl)
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Your have deadline</h4>
                                    <p>{{ $dl->title }}</p>
                                    <p>{{ $dl->end_date }}</p>
                                </div>
                            </li>
                        @endforeach
                    @endif

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('seeder/profile/profile.jpg') }}" class="img-fluid rounded-circle"
                        alt="profile">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                        <span>{{ auth()->user()->role->name }}</span>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<script>
    // Ambil elemen input tanggal
    var dateInput = document.getElementById('date-input');

    // Tambahkan event listener untuk perubahan nilai
    dateInput.addEventListener('input', function() {
        // Submit formulir saat nilai tanggal berubah
        document.getElementById('search-form').submit();
    });
</script>
