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
                <h3>Data Santri PKL</h3>
                <p class="text-subtitle text-muted">list santri yang sedang menjalankan pkl</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section shadow mb-4">
        <div class="card">
            @if (auth()->user()->status == "admin")
                <div class="card-header">
                    <a href="{{ route('addSantri') }}"><button class="btn btn-outline-primary">Tambah Santri</button></a>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#uploadSantri">Tambah Banyak Santri</button>
                </div>
            @else
                <div class="card-header">
                    <h3>Daftar Santri Bimbingan Laporan</h3>
                </div>
            @endif
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nisn</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Perusahaan</th>
                            <th>Kota</th>
                            <th>Jumlah Laporan</th>
                            @if (auth()->user()->status == "admin")
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->nisn }}</td>
                                <td>{{ $item->nama_santri }}</td>
                                <td>{{ $item->kelas_santri }}</td>
                                <td>{{ $item->perusahaan_santri }}</td>
                                <td>{{ $item->daerah_perusahaan_santri }}</td>
                                <td><center>{{ $item->jumlah }}</center></td>
                                @if (auth()->user()->status == "admin")
                                    <td>
                                        <a href="{{ route('jurnalSantri',$nisn = $item->nisn) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Jurnal</button></a>
                                        <a href="{{ route('editSantri',$nisn = $item->nisn) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                        <form action="{{ route('deleteSantri',$nisn = $item->nisn) }}" method="post">
                                        @csrf
                                        @method("delete")
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    @if (auth()->user()->status == "pembimbing")
        <section class="section shadow">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Santri Bimbingan Perusahaan</h3>
                </div>
                <div class="card-body">
                    @include('layouts/massage')
                    <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>Nisn</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Perusahaan</th>
                                <th>Kota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPT as $item)
                                <tr>
                                    <td>{{ sprintf("%07d", $item->nisn) }}</td>
                                    <td>{{ $item->nama_santri }}</td>
                                    <td>{{ $item->kelas_santri }}</td>
                                    <td>{{ $item->perusahaan_santri }}</td>
                                    <td>{{ $item->daerah_perusahaan_santri }}</td>
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

<div class="modal fade" id="uploadSantri" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('uploadSantri') }}" class="form" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Data Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="upload-column">Masukkan File XLSX Disini</label>
                    <input type="file" id="upload-column" class="form-control"
                        placeholder="Masukkan File" name="file" required>
                    <p>Contoh format xlsx bisa di download <a href="{{ route('contohFile') }}"><strong>Disini</strong></a></p>
                    <p>Kolom 1 = Nisn</p>
                    <p>Kolom 2 = Nama Santri</p>
                    <p>Kolom 3 = Email Santri</p>
                    <p>Kolom 4 = Nomor Telepon</p>
                    <p>Kolom 5 = Kelas Santri (Kapital)</p>
                    <p>Kolom 6 = Perusahaan Santri</p>
                    <p>Kolom 7 = Dearah Perusahaan</p>
                    <p>Kolom 8 = ID Pembimbing (bisa di lihat di data pembimbing)</p>
                    <p>Kolom 9 = ID Pembimbing Lapangan 1 (bisa di lihat di data pembimbing)</p>
                    <p>Kolom 10 = ID Pembimbing Lapangan 2 (bisa di lihat di data pembimbing)</p>
                    <p>Kolom 11 = Angkatan</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
      </div>
    </div>
  </div>  
@endsection