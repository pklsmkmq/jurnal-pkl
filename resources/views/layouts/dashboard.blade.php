<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PKL SMK MQ</title>
    <link rel="shortcut icon" href="{{ url('assets/images/logo.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ url('bs5/css/bootstrap.min.css') }}">
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
                            <a href="{{ route('dashboard') }}"><img src="{{ url('assets/images/logo/mysmk.png') }}" alt="logo"></a>
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

                        @if (auth()->user()->status == "admin" || auth()->user()->status == "pembimbing")
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
                                    <span>Pembimbing</span>
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

                        @if (auth()->user()->status != "santri")
                            <li class="sidebar-item  {{ (request()->segment(2) == 'kunjungan') ? 'active' : '' }}">
                                <a href="{{ route('kunjungan') }}" class='sidebar-link'>
                                    <i class="iconly-boldShow"></i>
                                    <span>Kunjungan</span>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->status == "admin")
                            <li class="sidebar-item  {{ (request()->segment(2) == 'pengaturan') ? 'active' : '' }}">
                                <a href="{{ route('pengaturan') }}" class='sidebar-link'>
                                    <i class="bi bi-gear-fill"></i>
                                    <span>Pengaturan</span>
                                </a>
                            </li>
                        @endif

                            <li class="sidebar-item  {{ (request()->segment(2) == 'bimbingan') ? 'active' : '' }}">
                                <a href="{{ route('bimbingan') }}" class='sidebar-link'>
                                    <i class="bi bi-book-half"></i>
                                    <span>Bimbingan Laporan</span>
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
    {{-- <script src="{{ url('assets/js/bs4.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
    {{-- <script src="{{ url('assets/js/pages/dashboard.js') }}"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> --}}

    <script src="{{ url('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('bs5/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ url('assets/vendors/apexcharts/apexcharts.js') }}"></script>
    
    <script src="{{ url('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/js/bootstrap-select.js') }}"></script>
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);

        let table2 = document.querySelector('#table2');
        let dataTable2 = new simpleDatatables.DataTable(table2);
    </script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            var dataX;
            $.get("{{ env('DATA_URL') }}", function(data, status){
                dataX = data;
                console.log(data);
                var optionsProfileVisit = {
                    annotations: {
                        position: 'back'
                    },
                    dataLabels: {
                        enabled:false
                    },
                    chart: {
                        type: 'bar',
                        height: 300
                    },
                    fill: {
                        opacity:1
                    },
                    plotOptions: {
                    },
                    series: [{
                        name: 'laporan santri',
                        data: dataX
                    }],
                    colors: '#435ebe',
                    xaxis: {
                        categories: ["Jun","Jul", "Aug","Sep","Oct"],
                    },
                }
                let optionsVisitorsProfile  = {
                    series: [70, 30],
                    labels: ['Male', 'Female'],
                    colors: ['#435ebe','#55c6e8'],
                    chart: {
                        type: 'donut',
                        width: '100%',
                        height:'350px'
                    },
                    legend: {
                        position: 'bottom'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '30%'
                            }
                        }
                    }
                }
                
                var optionsEurope = {
                    series: [{
                        name: 'series1',
                        data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
                    }],
                    chart: {
                        height: 80,
                        type: 'area',
                        toolbar: {
                            show:false,
                        },
                    },
                    colors: ['#5350e9'],
                    stroke: {
                        width: 2,
                    },
                    grid: {
                        show:false,
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
                        axisBorder: {
                            show:false
                        },
                        axisTicks: {
                            show:false
                        },
                        labels: {
                            show:false,
                        }
                    },
                    show:false,
                    yaxis: {
                        labels: {
                            show:false,
                        },
                    },
                    tooltip: {
                        x: {
                            format: 'dd/MM/yy HH:mm'
                        },
                    },
                };
                
                let optionsAmerica = {
                    ...optionsEurope,
                    colors: ['#008b75'],
                }
                let optionsIndonesia = {
                    ...optionsEurope,
                    colors: ['#dc3545'],
                }
                
                
                
                var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
                var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
                var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
                var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
                var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);
                
                chartIndonesia.render();
                chartAmerica.render();
                chartEurope.render();
                chartProfileVisit.render();
                chartVisitorsProfile.render();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            
            function formatDate(date) {
                var d = new Date(date),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) 
                    month = '0' + month;
                if (day.length < 2) 
                    day = '0' + day;

                return [year, month, day].join('-');
            }

            $("#bla").change(function() {
                var today = new Date();

                if ($("#bla").val() == formatDate(today)) {
                    $("#blok-kegiatan").css("display","block");
                    $("#kegiatan").val("on");
                } else {
                    $("#blok-kegiatan").css("display","none");
                    $("#kegiatan").val("off");
                }
            })
        });
    </script>
</body>

</html>