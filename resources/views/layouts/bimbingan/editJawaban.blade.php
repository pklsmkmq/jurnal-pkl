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
                <h3>Ubah Jawaban {{ $data->tugas->nama_tugas }}</h3>
                <p class="text-subtitle text-muted">Antum dapat mengubah jawaban {{ $data->nama_tugas }} disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bimbingan') }}">Bimbingan Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Jawaban</li>
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
                        @if ($data->revisi != null && $data->revisi->status_revisi == "Revisi")
                            <div class="card-header bg-warning">
                                <h4>Keterangan Revisi Guru Pembimbing</h4>
                                <span>{{ $data->revisi->keterangan_revisi }}</span>
                            </div>
                        @endif
                        <div class="card-body mt-3">
                            @include('layouts/massage')
                            <form class="form" method="POST" action="{{ route('updateJawaban',$id = $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="pt-column">Link Jawaban</label><br>
                                            <span><i>File harus diupload ke dalam google drive & share linknya kesini</i></span>
                                            <input type="text" id="pt-column" class="form-control"
                                                placeholder="link jawaban" name="link_jawaban" required value="{{ $data->link_jawaban }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Keterangan Jawaban</label>
                                            <textarea class="form-control" name="keterangan_jawaban" placeholder="Tambahkan keterangan ke guru pembimbing" rows="5" required>{{ $data->keterangan_jawaban }}</textarea>
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