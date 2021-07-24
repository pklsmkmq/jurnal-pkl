@extends('layouts/dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
@php
    $nomor = 0;
@endphp
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

    @if (auth()->user()->status == "pembimbing")
        <section class="section shadow rounded">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Perusahaan Kelompok Antum</h3>
                </div>
                <div class="card-body">
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
                            @foreach ($dataKunjungan as $item)
                                @php
                                    $nomor++;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $nomor }}</td>
                                    <td>{{ $item->perusahaan_santri }}</td>
                                    <td>{{ $item->daerah_perusahaan_santri }}</td>
                                    <td class="text-center">{{ $item->sisa }}</td>
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
                    <h3>Daftar Riwayat Kunjungan Kelompok Antum</h3>
                    <a href="{{ route('addKunjungan') }}"><button class="btn btn-outline-primary">Tambah Kunjungan</button></a>
                </div>
                <div class="card-body">
                    @include('layouts/massage')
                    <table class="table table-striped" id="table2">
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
                            @php
                                $nomor = 0;
                            @endphp
                            @foreach ($kunjungan as $item)
                                @php
                                    $nomor++;
                                @endphp
                                <tr>
                                    <td>{{ $nomor }}</td>
                                    <td>{{ $item->nama_perusahaan_kunjungan }}</td>
                                    <td>{{ $item->kunjungan_ke }}</td>
                                    <td>{{ $item->tanggal_kunjungan }}</td>
                                    <td>
                                        <a href="{{ route('kunjunganDetail',$id = $item->id) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                        <a href="{{ route('editKunjungan',$id = $item->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif

    @if (auth()->user()->status == "admin" || auth()->user()->status == "walsan" )
        <section class="section  shadow rounded">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Kunjungan Perusahaan</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembimbing</th>
                                <th>Nama Perusahaan</th>
                                <th>Kunjungan Ke</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungan as $item)
                                @php
                                    $nomor++;
                                @endphp
                                <tr>
                                    <td>{{ $nomor }}</td>
                                    <td>{{ $item->pembimbing->nama_pembimbing }}</td>
                                    <td>{{ $item->nama_perusahaan_kunjungan }}</td>
                                    <td>{{ $item->kunjungan_ke }}</td>
                                    <td>{{ $item->tanggal_kunjungan }}</td>
                                    <td>
                                        <a href="{{ route('kunjunganDetail',$id = $item->id) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    @endif
</div>

@include('layouts/footer')

@endsection