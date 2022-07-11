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
                <h3>Tambah Santri</h3>
                <p class="text-subtitle text-muted">Antum bisa menambah data santri disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('santri') }}">Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambahkan Santri</li>
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
                            <form class="form" method="POST" action="{{ route('saveSantri') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nisn-column">Nisn</label>
                                            <input type="number" id="nisn-column" class="form-control"
                                                placeholder="Masukkan NISN" name="nisn" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama-column">Nama Santri</label>
                                            <input type="text" id="nama-column" class="form-control"
                                                placeholder="Masukkan Nama Santri" name="nama_santri" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-column">Email Santri</label>
                                            <input type="email" id="email-column" class="form-control"
                                                placeholder="Masukkan Email" name="email_santri" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon-column">Telepon Santri</label>
                                            <input type="text" id="telepon-column" class="form-control"
                                                name="telepon_santri" placeholder="Masukkan Telepon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kelas-column">Kelas Santri</label>
                                            <select class="selectpicker form-control" id="kelas-column" data-container="body" data-live-search="true" name="kelas_santri" title="Pilih Kelas" data-hide-disabled="true" required>
                                                <option value="XII RPL">XII RPL</option>
                                                <option value="XII TKJ">XII TKJ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="angkatan">Angkatan</label>
                                            <select class="form-control" id="angkatan" name="angkatan" placeholder="Pilih Angkatan" required>
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="perusahaan-column">Perusahaan Santri</label>
                                            <input type="text" id="perusahaan-column" class="form-control"
                                                placeholder="Masukkan Nama Perusahaan" name="perusahaan_santri" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="daerah-column">Daerah Perusahaan Santri</label>
                                            <input type="text" id="daerah-column" class="form-control"
                                                placeholder="Masukkan Daerah Perusahaan" name="daerah_perusahaan_santri" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-column">Pembimbing</label>
                                            <select class="selectpicker form-control" id="pembimbing-column" data-container="body" data-live-search="true" name="pembimbing_id" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-column1">Pembimbing Lapangan 1</label>
                                            <select class="selectpicker form-control" id="pembimbing-column1" data-container="body" data-live-search="true" name="pembimbing_lapangan_1" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-column2">Pembimbing Lapangan 2</label>
                                            <select class="selectpicker form-control" id="pembimbing-column2" data-container="body" data-live-search="true" name="pembimbing_lapangan_2" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>
                                                @endforeach
                                            </select>
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