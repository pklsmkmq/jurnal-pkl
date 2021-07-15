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
                <h3>Data Kunjungan PKL</h3>
                <p class="text-subtitle text-muted">List Kunjungan PKL ke perusahaan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kunjungan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section shadow rounded">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Perusahaan Kelompok Antum</h3>
            </div>
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Kota</th>
                            <th>Sisa Kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td class="text-center">1</td>
                                <td>{{ $item->perusahaan_santri }}</td>
                                <td>{{ $item->daerah_perusahaan_santri }}</td>
                                <td class="text-center">3</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="section  shadow rounded">
        <div class="card">
            <div class="card-header">
                <h3>Daftar Riwayat Kunjungan</h3>
                <a href="{{ route('addKunjungan') }}"><button class="btn btn-outline-primary">Tambah Kunjungan</button></a>
            </div>
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Kunjungan Ke</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kunjungan as $item)
                            <tr>
                                <td>1</td>
                                <td>{{ $item->nama_perusahaan_kunjungan }}</td>
                                <td>{{ $item->kunjungan_ke }}</td>
                                <td>{{ $item->tanggal_kunjungan }}</td>
                                <td>
                                    <a href="{{ route('addKunjungan') }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>

@include('layouts/footer')

@endsection