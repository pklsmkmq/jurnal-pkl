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
                <h3>Kunjungan Ke {{ $data->kunjungan_ke }} Di Perusahaan</h3>
                <h5>{{ $data->nama_perusahaan_kunjungan }}</h5>
                <p class="text-subtitle text-muted">{{ $data->updated_at->diffForHumans() }}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kunjungan') }}">Kunjungan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kunjungan Detail</li>
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
                        <h3>Detail Laporan</h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <a href="{{ $data->foto_dokumentasi_kunjungan }}" target="_blank"><img src="{{ $data->foto_dokumentasi_kunjungan }}" alt="jurnal santri" class="rounded d-block img-fluid detail-jurnal mb-5"></a>
                            <strong>Deskripsi Kunjungan:</strong>
                            <p>{{ $data->keterangan_kunjungan }}</p>
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