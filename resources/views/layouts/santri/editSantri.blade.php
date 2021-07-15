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
                <h3>Edit Santri</h3>
                <p class="text-subtitle text-muted">Antum bisa menambah data santri disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('santri') }}">Santri</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Santri</li>
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
                            <form class="form" method="POST" action="{{ route('updateSantri',$nisn = $data->nisn) }}">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama-column">Nama Santri</label>
                                            <input type="text" id="nama-column" class="form-control"
                                                placeholder="Masukkan Nama Santri" name="nama_santri" required value="{{ $data->nama_santri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-column">Email Santri</label>
                                            <input type="email" id="email-column" class="form-control"
                                                placeholder="Masukkan Email" name="email_santri" required value="{{ $data->email_santri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon-column">Telepon Santri</label>
                                            <input type="text" id="telepon-column" class="form-control"
                                                name="telepon_santri" placeholder="Masukkan Telepon" required value="{{ $data->telepon_santri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="kelas-column">Kelas Santri</label>
                                            <select name="kelas_santri" class="form-control">
                                                <option value="XII RPL" @if ($data->kelas_santri == "XII RPL")
                                                    selected
                                                @endif>XII RPL</option>
                                                <option value="XII TKJ" @if ($data->kelas_santri == "XII TKJ")
                                                    selected
                                                @endif>XII TKJ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="angkatan">Angkatan</label>
                                            <select class="form-control" id="angkatan" name="angkatan" placeholder="Pilih Angkatan" required>
                                                @for ($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}" @if ($data->angkatan == $i)
                                                        selected
                                                    @endif>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="perusahaan-column">Perusahaan Santri</label>
                                            <input type="text" id="perusahaan-column" class="form-control"
                                                placeholder="Masukkan Nama Perusahaan" name="perusahaan_santri" required value="{{ $data->perusahaan_santri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="daerah-column">Daerah Perusahaan Santri</label>
                                            <input type="text" id="daerah-column" class="form-control"
                                                placeholder="Masukkan Daerah Perusahaan" name="daerah_perusahaan_santri" required value="{{ $data->daerah_perusahaan_santri }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-column">Pembimbing</label>
                                            <select class="selectpicker form-control" id="pembimbing-column" data-container="body" data-live-search="true" name="pembimbing_id" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($pemb as $item)
                                                    @if ($item->id == $data->pembimbing_id)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama_pembimbing }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-lap1">Pembimbing Lapangan 1</label>
                                            <select class="selectpicker form-control" id="pembimbing-lap1" data-container="body" data-live-search="true" name="pembimbing_lapangan_1" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($pemb as $item)
                                                    @if ($item->id == $data->pembimbing_lapangan_1)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama_pembimbing }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>    
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembimbing-lap2">Pembimbing Lapangan 2</label>
                                            <select class="selectpicker form-control" id="pembimbing-lap2" data-container="body" data-live-search="true" name="pembimbing_lapangan_2" title="Pilih Pembimbing" data-hide-disabled="true" required>
                                                @foreach ($pemb as $item)
                                                    @if ($item->id == $data->pembimbing_lapangan_2)
                                                        <option value="{{ $item->id }}" selected>{{ $item->nama_pembimbing }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->nama_pembimbing }}</option>    
                                                    @endif
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