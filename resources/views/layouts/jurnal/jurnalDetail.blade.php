@extends('layouts/dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan Jurnal Santri</h3>
                <h5>{{ $data->santri->nama_santri }}</h5>
                <p class="text-subtitle text-muted">{{ $data->created_at->diffForHumans() }}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('jurnal') }}">Jurnal</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h1>{{ $data->judul_jurnal }}</h1>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ $data->foto_dokumentasi_jurnal }}" target="_blank"><img src="{{ $data->foto_dokumentasi_jurnal }}" alt="jurnal santri" class="rounded d-block img-fluid detail-jurnal mb-5"></a>
                            <strong>Deskripsi Jurnal:</strong>
                            <p>{{ $data->deskripsi_jurnal }}</p>
                        </div>
                    </div>
                </div>
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3>Kegiatan Harian</h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if ($kegiatan)
                                <div class="row">
                                    <strong>Dzikir</strong>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->dzikir_pagi == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Dzikir Pagi</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->dzikir_petang == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Dzikir Petang</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Sholat</strong>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->subuh == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Sholat Subuh</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->dzuhur == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Sholat Dzuhur</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->ashar == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Sholat Ashar</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->maghrib == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Sholat Maghrib</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->isya == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif    
                                            </div>
                                            <div class="col-11"><p>Sholat Isya</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Mengaji</strong>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1">
                                                @if ($kegiatan->baca_alquran == "sudah")
                                                    <i style="color: blue;font-size: 20px;" class="bi bi-check-square"></i>
                                                @else
                                                    <i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i>
                                                @endif
                                            </div>
                                            <div class="col-11"><p>Membaca Al Qur'an 1 Juz</p></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h3>Kegiatan Harian</h3>
                                <div class="row">
                                    <strong>Dzikir</strong>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Dzikir Pagi</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Dzikir Petang</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Sholat</strong>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Sholat Subuh</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Sholat Dzuhur</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Sholat Ashar</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Sholat Maghrib</p></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Sholat Isya</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <strong>Mengaji</strong>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-1"><i style="color: red;font-size: 20px;" class="bi bi-file-excel"></i></div>
                                            <div class="col-11"><p>Membaca Al Qur'an 1 Juz</p></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@include('layouts/footer')
@endsection