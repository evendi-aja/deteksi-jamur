<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>C5 - {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('template') }}/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Sistem Identifikasi</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link {{ $title === 'Dashboard' ? 'active' : '' }}" href="/dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{ $title === 'Proses Identifikasi' ? 'active' : '' }}"
                            href="/identifikasi">
                            <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                            Identifikasi
                        </a>
                        <a class="nav-link collapsed {{ $title === 'Data Set' || $title === 'Data Latih' || $title === 'Data Test' ? 'active' : '' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-server"></i></div>
                            Data
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ $title === 'Data Set' ? 'active' : '' }}"
                                    href="/data/dataset">DataSet</a>
                                <a class="nav-link {{ $title === 'Data Latih' ? 'active' : '' }}"
                                    href="/data/datalatih">Data Latih</a>
                                <a class="nav-link {{ $title === 'Data Test' ? 'active' : '' }}"
                                    href="/data/datatest">Data Test</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed {{ $title === 'Perhitungan Awal' || $title === 'Hasil Perhitungan Awal' || $title === 'Perhitungan Pruning' || $title === 'Hasil Perhitungan Pruning' ? 'active' : '' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Perhitungan
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ $title === 'Perhitungan Awal' || $title === 'Hasil Perhitungan Awal' ? 'active' : '' }}"
                                    href="/latih/perhitunganawal">Perhitungan Awal</a>
                                <a class="nav-link {{ $title === 'Perhitungan Pruning' || $title === 'Hasil Perhitungan Pruning' ? 'active' : '' }}"
                                    href="/latih/perhitunganpruning">Pruning</a>
                                <a class="nav-link {{ $title === 'Hasil Boosting' ? 'active' : '' }}"
                                    href="/latih/boosting">Boosting</a>
                            </nav>
                        </div>
                        <a class="nav-link {{ $title === 'Proses Boosting' ? 'active' : '' }}"
                            href="/prosesboosting">
                            <div class="sb-nav-link-icon"><i class="fas fa-random"></i></div>
                            Proses Boosting dan Grafik
                        </a>
                        <a class="nav-link {{ $title === 'Hitung Data Latih' ? 'active' : '' }}" href="/tree">
                            <div class="sb-nav-link-icon"><i class="fas fa-random"></i></div>
                            Hitung Data Latih
                        </a>
                        <a class="nav-link {{ $title === 'Hitung Data Testing' ? 'active' : '' }}"
                            href="/hitungtesting">
                            <div class="sb-nav-link-icon"><i class="fas fa-align-justify"></i></div>
                            Hitung Data Testing
                        </a>
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Data Testing
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link {{ $title === 'Data Testing' ? 'active' : '' }}"
                                    href="/testing">Data Testing</a>
                                <a class="nav-link {{ $title === 'Akurasi' ? 'active' : '' }}"
                                    href="/testing/akurasi">Akurasi</a>
                            </nav>
                        </div> --}}
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ auth()->user()->username }}
                </div>
            </nav>
        </div>

        @yield('container')

    </div>

    @stack('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('template') }}/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('template') }}/assets/demo/chart-area-demo.js"></script>
    <script src="{{ asset('template') }}/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('template') }}/js/datatables-simple-demo.js"></script>
</body>

</html>
