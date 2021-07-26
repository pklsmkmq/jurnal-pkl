@extends('layouts/dashboard')

@section('content')
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
@php
    $nomor = 0;
@endphp
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Wali Santri</h3>
                <p class="text-subtitle text-muted">list wali santri</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wali Santri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('addWalsan') }}"><button class="btn btn-outline-primary">Tambah Wali Santri</button></a>
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#uploadWalsan">Tambah Banyak Wali Santri</button>
            </div>
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Wali Santri</th>
                            <th>Nama Santri</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @php
                                $nomor++;
                            @endphp
                            <tr>
                                <td>{{ $nomor }}</td>
                                <td>{{ $item->nama_walsan }}</td>
                                <td>{{ $item->nama_walsan }}</td>
                                <td>{{ $item->email_walsan }}</td>
                                <td>{{ $item->telepon_walsan }}</td>
                                <td>
                                    <a href="{{ route('editWalsan',$id = $item->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                    <form action="{{ route('deleteWalsan',$id = $item->id) }}" method="post">
                                      @csrf
                                      @method("delete")
                                      <button class="btn btn-danger" type="submit">Delete</button>
                                  </form>
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

<div class="modal fade" id="uploadWalsan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('uploadWalsan') }}" class="form" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Data Walsan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label for="upload-column">Masukkan File XLSX Disini</label>
                    <input type="file" id="upload-column" class="form-control"
                        placeholder="Masukkan File" name="file" required>
                    <p>Contoh format xlsx bisa di download <a href="{{ route('contohFileWalsan') }}"><strong>Disini</strong></a></p>
                    <p>Kolom 1 = Nisn Santri</p>
                    <p>Kolom 2 = Nama Walsan</p>
                    <p>Kolom 3 = Email Walsan</p>
                    <p>Kolom 4 = Nomor Telepon Walsan</p>
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