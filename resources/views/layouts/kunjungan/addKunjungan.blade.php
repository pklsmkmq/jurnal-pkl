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
                <h3>Tambah Kunjungan</h3>
                <p class="text-subtitle text-muted">Antum bisa menambahkan data Kunjungan disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('kunjungan') }}">Kunjungan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambahkan Kunjungan</li>
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
                            @include('layouts/massage')
                            <form class="form" method="POST" action="{{ route('saveKunjungan') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pt-column">Nama Perusahaan</label>
                                            <select class="selectpicker form-control" data-container="body" data-live-search="true" name="nama_perusahaan_kunjungan" title="Pilih Perusahaan Santri" data-hide-disabled="true" required>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->perusahaan_santri }}">{{ $item->perusahaan_santri }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Tanggal Kunjungan</label>
                                            <input class="form-control" name="tanggal_kunjungan" type="date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="foto-column">Foto Dokumentasi</label>
                                            <input type="file" id="foto-column" name="foto_dokumentasi_kunjungan" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Deskripsi Jurnal Harian</label>
                                            <textarea class="form-control" name="keterangan_kunjungan" placeholder="Jelaskan Kunjungan Antum Hari Ini" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
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