<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Perpustakaan</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('template') }}/img/brand/favicon.png" type="image/png">

    <link rel="stylesheet" href="{{ asset('template') }}/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="{{ asset('template') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css"
        type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('template') }}/css/argon.css?v=1.2.0" type="text/css">

    {{-- sweet alert  --}}
    <link rel="stylesheet" href="{{ asset('sweetalert2.min.css') }}">

    {{-- material dsign --}}
    <link rel="stylesheet" href="{{ asset('materialdesignicons.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}"> --}}
   
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>


    <body>
        
        
    
        <!-- Sidenav -->
        <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                <!-- Brand -->
                <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                        <img src="{{ asset('template') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
                    </a>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    
                    <ul class="navbar-nav">
                        
                        
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        
                    
                        @auth
                        
                        @if (Auth::user()->level == 'admin')  
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('buku') ? 'active' : '' }}"
                                href="{{ route('buku.index') }}">
                                <i class="ni ni-books text-green"></i>
                                <span class="nav-link-text">Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('anggota') ? 'active' : '' }}"
                                href="{{ route('anggota.index') }}">
                                <i class="ni ni-single-02 text-orange"></i>
                                <span class="nav-link-text">Anggota</span>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'user')
                            
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('transaksi') ? 'active' : '' }}"
                                href="{{ route('transaksi.index') }}">
                                <i class="ni ni-ruler-pencil text-red"></i>
                                <span class="nav-link-text">Transaksi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('riwayat') ? 'active' : '' }}"
                                href="{{ route('riwayat.index') }}">
                                <i class="ni ni-support-16 text-purple"></i>
                                <span class="nav-link-text">Riwayat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('laporan') ? 'active' : '' }}"
                                href="{{ route('laporan.index') }}">
                                <i class="ni ni-single-copy-04 text-cyan"></i>
                                <span class="nav-link-text">Laporan</span>
                            </a>
                        </li>
                        @endif
                        @endauth
                    </ul>
                    
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  
                    @auth
                    <ul class="navbar-nav align-items-center ml-md-auto ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder"
                                            src="{{ asset('template') }}/img/theme/team-4.jpg">
                                        </span>
                                        <div class="media-body  ml-2  d-none d-lg-block">
                                            <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right ">

                                    <a href="{{ route('petugas.index') }}" class="dropdown-item">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span>Settings</span>
                                    </a>
                                    
                                    
                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            <i class="ni ni-bold-right"></i> <span>{{ __('Logout') }}</span>
                                        </a>
                                        
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                        
                                
                                </div>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    @yield('content')
                    @yield('modal')
                </div>
                
                
            </div>
        </div>
        
        
    </div>
    
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('template') }}/vendor/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template') }}/vendor/js-cookie/js.cookie.js"></script>
    <script src="{{ asset('template') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="{{ asset('template') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="{{ asset('template') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('template') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="{{ asset('template') }}/js/argon.js?v=1.2.0"></script>
    
    {{-- sweet alert  --}}
    <script src="{{ asset('sweetalert2.min.js') }}"></script>
    <script src="{{ asset('popper.js') }}"></script>
    <script src="{{ asset('jquery.js') }}"></script>
    <script src="{{ asset('moment.js') }}"></script>    

    @stack('script')
</body>

</html>
