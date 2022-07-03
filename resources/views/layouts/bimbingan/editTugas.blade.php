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
                <h3>Ubah Tugas Laporan</h3>
                <p class="text-subtitle text-muted">Antum bisa mengubah tugas laporan disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bimbingan') }}">Bimbingan Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Tugas Laporan</li>
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
                            <form class="form" method="POST" action="{{ route('saveTugas') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pt-column">Judul Tugas *</label>
                                            <input type="text" id="pt-column" class="form-control"
                                                placeholder="misal Bab 1" name="nama_tugas" value="{{ $data->nama_tugas }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="batas_pengumpulan_tugas">Batas Pengumpulan Tugas *</label>
                                            <input class="form-control" id="batas_pengumpulan_tugas" name="batas_pengumpulan_tugas" value="{{ $dt }}" type="datetime-local" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="file_tugas">File Tugas</label><br>
                                            @if ($data->file_tugas != null)
                                                <a href="{{ $data->file_tugas }}" target="_blank"><button class="btn btn-outline-primary mb-2" alt="Download File Tugas Sebelumnya" type="button">File Tugas Sebelumnya</button></a>
                                            @endif
                                            <span class="fst-italic">Opsional (Jika terdapat contoh atau panduan tugas)</span>
                                            <input type="file" id="file_tugas" name="file_tugas" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Deskripsi Tugas</label>
                                            <textarea class="form-control" name="deskripsi_tugas" placeholder="Jelaskan Kunjungan Antum Hari Ini" rows="5" required>{{ $data->deskripsi_tugas }}</textarea>
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