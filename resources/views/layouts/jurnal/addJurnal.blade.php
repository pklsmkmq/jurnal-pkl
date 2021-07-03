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
                <h3>Buat Jurnal Harian</h3>
                <p class="text-subtitle text-muted">Antum bisa membuat jurnal harian disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Buat Jurnal</li>
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
                            <form class="form" method="POST" action="{{ route('saveJurnal') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="judul-column">Judul Jurnal Harian</label>
                                            <input type="text" id="judul-column" class="form-control"
                                                placeholder="Masukkan judul jurnal" name="judul_jurnal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Tanggal Jurnal</label>
                                            <input class="form-control" id="bla" name="tanggal_jurnal" type="date" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="foto-column">Foto Dokumentasi</label>
                                            <input type="file" name="foto_dokumentasi_jurnal" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="desc-column">Deskripsi Jurnal Harian</label>
                                            <textarea class="form-control" rows="5" name="deskripsi_jurnal" placeholder="Apa yang antum kerjakan hari ini?" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12" id="blok-kegiatan">
                                        <h5>Kegiatan Ceklis Harian</h5>
                                        <input type="hidden" name="kegiatan" id="kegiatan">
                                        <div class="row">
                                            <strong>Dzikir</strong>
                                            <div class="form-group col-lg-6 col-12">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="dzikirPagi" name="dzikir_pagi" value="sudah">
                                                <label class="form-check-label" for="dzikirPagi">Sudah Dzikir Pagi</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6 col-12">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="dzikirPetang" name="dzikir_petang" value="sudah">
                                                <label class="form-check-label" for="dzikirPetang">Sudah Dzikir Petang</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <strong>Sholat</strong>
                                            <div class="form-group col-lg-12 col-6">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sholatSubuh" name="subuh" value="sudah">
                                                <label class="form-check-label" for="sholatSubuh">Sudah Sholat Subuh</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12 col-6">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sholatDzuhur" name="dzuhur" value="sudah">
                                                <label class="form-check-label" for="sholatDzuhur">Sudah Sholat Dzuhur</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12 col-6">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sholatAshar" name="ashar" value="sudah">
                                                <label class="form-check-label" for="sholatAshar">Sudah Sholat Ashar</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12 col-6">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sholatMaghrib" name="maghrib" value="sudah">
                                                <label class="form-check-label" for="sholatMaghrib">Sudah Sholat Maghrib</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12 col-6">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="sholatIsya" name="isya" value="sudah">
                                                <label class="form-check-label" for="sholatIsya">Sudah Sholat Isya</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <strong>Membaca Al Qur'an</strong>
                                            <div class="form-group col-12">
                                                <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="membacaAlquran" name="baca_alquran" value="sudah">
                                                <label class="form-check-label" for="membacaAlquran">Sudah Membaca Al Qur'an 1 Juz</label>
                                                </div>
                                            </div>
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