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
                <h3>Data Riwayat Kunjungan PKL</h3>
                <p class="text-subtitle text-muted">List Riwayat Kunjungan PKL ke perusahaan</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kunjungan') }}">Kunjungan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Kunjungan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Perusahaan</th>
                            <th>Kota</th>
                            <th>Sisa Kunjungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>1</td>
                                <td>{{ $item->perusahaan_santri }}</td>
                                <td>{{ $item->daerah_perusahaan_santri }}</td>
                                <td>3</td>
                                <td>
                                    <a href="{{ route('addKunjungan') }}"><button class="btn btn-primary mb-1 float-left mr-1">Add Kunjungan</button></a>
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