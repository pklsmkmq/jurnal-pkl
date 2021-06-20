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
                <h3>Data Jurnal Harian Santri</h3>
                <p class="text-subtitle text-muted">list jurnal santri</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Jurnal Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            @if (auth()->user()->status == "santri")
                <div class="card-header">
                    <a href="{{ route('addJurnal') }}"><button class="btn btn-outline-primary">Tambah Jurnal</button></a>
                </div>
            @endif
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Santri</th>
                            <th>Judul Jurnal</th>
                            <th>Deskripsi Jurnal</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->santri->nama_santri }}</td>
                                <td>{{ $item->judul_jurnal }}</td>
                                <td>{{ Str::substr($item->deskripsi_jurnal, 0, 100) . "..." }}</td>
                                <td>{{ $item->tanggal_jurnal }}</td>
                                <td>
                                    <a href="{{ route('jurnalDetail',$id = $item->id) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                    @if (auth()->user()->status == "santri")
                                        <a href="{{ route('jurnalEdit',$id = $item->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                    @endif
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