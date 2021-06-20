<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ url('assets/images/favicon.svg" type="image/x-icon') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/simple-datatables/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-select.min.css') }}">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('dashboard') }}"><h1>Dashboard PKL</h1></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  {{ (request()->segment(2) == '' || request()->segment(2) == 'dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if (auth()->user()->status == "admin")
                            <li class="sidebar-item  {{ (request()->segment(2) == 'santri') ? 'active' : '' }}">
                                <a href="{{ route('santri') }}" class='sidebar-link'>
                                    <i class="bi bi-person-badge-fill"></i>
                                    <span>Santri</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->status == "admin")
                            <li class="sidebar-item  {{ (request()->segment(2) == 'pembimbing') ? 'active' : '' }}">
                                <a href="{{ route('pembimbing') }}" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Pendamping</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->status == "admin")
                            <li class="sidebar-item  {{ (request()->segment(2) == 'walisantri') ? 'active' : '' }}">
                                <a href="{{ route('walsan') }}" class='sidebar-link'>
                                    <i class="bi bi-person-square"></i>
                                    <span>Wali Santri</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item  {{ (request()->segment(2) == 'jurnal') ? 'active' : '' }}">
                            <a href="{{ route('jurnal') }}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-post"></i>
                                <span>Jurnal</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                this.closest('form').submit();" class="sidebar-link">
                                    <i class="bi bi-box-arrow-in-left"></i>
                                    <span>Log Out</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            @yield('content')
        </div>
    </div>
    <script src="{{ url('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/bs4.js') }}"></script> --}}
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="{{ url('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ url('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ url('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/js/bootstrap-select.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
    <script src="{{ url('assets/js/main.js') }}"></script>
</body>

</html>