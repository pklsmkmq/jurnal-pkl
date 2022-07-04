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
                <h3>Detail Tugas Laporan</h3>
                <p class="text-subtitle text-muted">Antum bisa melihat tugas laporan disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bimbingan') }}">Bimbingan Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Tugas Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="container">
                                <h2>{{ $data->nama_tugas }}</h2>
                                <span class="float-end">Batas Pengumpulan Tugas : {{ str_replace(" ", " | ",$data->batas_pengumpulan_tugas) }}</span>
                            </div>
                            <div class="container">
                                <h6 class="float-none">Keterangan</h6>
                                <p>{{ $data->deskripsi_tugas }}</p>
                            </div>
                            @if ($data->file_tugas != null)
                                <div class="container row">
                                    @if (auth()->user()->status == "santri")
                                        <a href="{{ $data->file_tugas }}" target="_blank"><button class="col-6 btn btn-primary">Download File Tugas</button></a>
                                        <button class="col-6 btn btn-success">Kerjakan Tugas</button>
                                    @else
                                        <a href="{{ $data->file_tugas }}" target="_blank"><button class="col-12 btn btn-primary">Download File Tugas</button></a>
                                    @endif
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