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
                <h3>Edit Jurnal Harian</h3>
                <p class="text-subtitle text-muted">Antum bisa edit jurnal harian disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jurnal</li>
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
                            <form class="form" method="POST" action="{{ route('updateJurnal',$id = $data->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="judul-column">Judul Jurnal Harian</label>
                                            <input type="text" id="judul-column" class="form-control"
                                                placeholder="Masukkan judul jurnal" name="judul_jurnal" required value="{{ $data->judul_jurnal }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Tanggal Jurnal</label>
                                            <input class="form-control" name="tanggal_jurnal" type="date" required value="{{ $data->tanggal_jurnal }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="foto-column">Foto Dokumentasi</label><br>
                                            <img src="{{ $data->foto_dokumentasi_jurnal }}" alt="Foto Dokumentasi" class="img-responsive mb-3" style="width: 20%"><br>
                                            <label for="foto-column">Ganti Foto</label>
                                            <input type="file" name="foto_dokumentasi_jurnal" class="form-control">
                                            <span style="font-style: italic; font-size: 12px; font-weight: bold;">*Kosongan jika antum tidak ingin mengganti foto</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Deskripsi Jurnal Harian</label>
                                            <textarea class="form-control" name="deskripsi_jurnal" placeholder="Apa yang antum kerjakan hari ini?" rows="10" required>{{ $data->deskripsi_jurnal }}</textarea>
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