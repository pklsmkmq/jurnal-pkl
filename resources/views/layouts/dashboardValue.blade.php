@extends('layouts/dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h4>أَهْلًا وَسَهْلًا</h4>
    <h3>{{ auth()->user()->name }}</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-3">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <h6 class="text-muted font-semibold text-front">
                                        @if (auth()->user()->status == "santri" || auth()->user()->status == "walsan")
                                            Kunjungan
                                        @else
                                            Santri
                                        @endif
                                    </h6>
                                    <h2 class="font-extrabold mb-0">{{ $data1 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-3">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <h6 class="text-muted font-semibold text-front">
                                        @if (auth()->user()->status == "pembimbing")
                                            Sisa Kunjungan
                                        @else
                                            Pembimbing
                                        @endif
                                    </h6>
                                    @if (auth()->user()->status == "santri" || auth()->user()->status == "walsan")
                                        <h6 class="font-extrabold mb-0">{{ $data2 }}</h6>
                                    @else
                                       <h2 class="font-extrabold mb-0">{{ $data2 }}</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-3">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <h6 class="text-muted font-semibold text-front">
                                        @if (auth()->user()->status == "pembimbing")
                                            Kunjungan Selesai
                                        @elseif(auth()->user()->status == "walsan")
                                            Nama Santri
                                        @else
                                            Wali Santri
                                        @endif
                                    </h6>
                                    @if (auth()->user()->status == "santri" || auth()->user()->status == "walsan")
                                        <h6 class="font-extrabold mb-0">{{ $data3 }}</h6>
                                    @else
                                       <h2 class="font-extrabold mb-0">{{ $data3 }}</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-3">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-9">
                                    <h6 class="text-muted font-semibold text-front">Total Jurnal</h6>
                                    <h2 class="font-extrabold mb-0">{{ $data4 }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Laporan Jurnal Harian</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-profile-visit"></div>
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->status == "admin")
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Santri Tidak Laporan</h4>
                        </div>
                        <div class="card-content pb-4">
                            <img src="{{ url('assets/images/bg/coming_soon.jpg') }}" style="width: 100%" alt="coming soon" class="img-responsive">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kunjungan PKL Baru Saja</h4>
                        </div>
                        <div class="card-body">
                            {{-- <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ url('assets/images/faces/5.jpg') }}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{ url('assets/images/faces/2.jpg') }}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Wow amazing design! Can you make another
                                                    tutorial for
                                                    this design?</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                            <img src="{{ url('assets/images/bg/coming_soon.jpg') }}" style="width: 100%" alt="coming soon" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl mr-3">
                            <div class="rounded bg-primary img-avatar">{{ $foto }}</div>
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ auth()->user()->name }}</h5>
                            <h6 class="text-muted mb-0">{{ auth()->user()->status }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Laporan Jurnal Baru Saja</h4>
                </div>
                <div class="card-content pb-4">
                    @if (count($recentJurnal) == 0)
                        <p style="text-align: center">Data Kosong</p>
                    @endif
                    @foreach ($recentJurnal as $item)
                        <div class="recent-message d-flex px-4 py-3">
                            <div class="avatar avatar-lg mr-3">
                                <div class="rounded bg-primary img-avatar">{{ $item->avatar }}</div>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $item->santri->nama_santri }}</h5>
                                <h6 class="text-muted mb-0">{{ $item->created_at->diffForHumans() }}</h6>
                            </div>
                        </div>
                    @endforeach
                    <div class="px-4">
                        <a href="{{ route('jurnal') }}"><button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Lihat Selengkapnya</button></a>
                    </div>
                </div>
            </div>
            @if (auth()->user()->status == "admin")
            <div class="card">
                <div class="card-header">
                    {{-- <h4>Coming Soon</h4> --}}
                </div>
                <div class="card-body">
                    {{-- <div id="chart-visitors-profile"></div> --}}
                    <img src="{{ url('assets/images/bg/coming_soon.jpg') }}" style="width: 100%" alt="coming soon" class="img-responsive">
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

@include('layouts/footer')
@endsection