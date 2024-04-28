<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scheduler</title>

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/favicon.png">

    @yield('script-head')
</head>

<body>

    @include('partials.navbar.navbar')
    @include('partials.sidebar.sidebar')

    <main class="main" id="main">
        <!-- Header main -->
        @yield('content')
        <!-- end header main -->
    </main>

    @yield('script-body')

    <!-- Vendor JS Files -->
    {{-- <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> --}}
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/js/main.js"></script>
</body>

</html>
