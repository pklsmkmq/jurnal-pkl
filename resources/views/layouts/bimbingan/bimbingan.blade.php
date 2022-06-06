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
                <h3>Data Bimbingan Laporan</h3>
                <p class="text-subtitle text-muted">Antum dapat memberikan tugas laporan dan mengkoreksi laporan disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bimbingan Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    
</div>

<section class="section shadow mb-4">
  <div class="card">
      <div class="card-header">
          <a href="{{ route('addSantri') }}"><button class="btn btn-success">Tambah Tugas Laporan</button></a>
      </div>
      <div class="card-body">
          @include('layouts/massage')
          <div class="container">
            <div class="accordion" id="accordionExample">
              @for ($i = 1; $i <= 10; $i++)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{ $i }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $i }}" aria-expanded="false" aria-controls="collapse{{ $i }}">
                      Bab #{{ $i }}
                    </button>
                  </h2>
                  <div id="collapse{{ $i }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $i }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <table class="table table-striped" id="table2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Link</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>1</td>
                              <td>Fullan</td>
                              <td>https://s.id</td>
                              <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, optio cum officia, deserunt exercitationem sit consequatur doloremque dolor laborum debitis blanditiis molestiae minima itaque odio harum iusto consectetur necessitatibus placeat.</td>
                              <td><button class="btn btn-outline-primary">Belum Diperiksa</button></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Saiful</td>
                              <td>https://s.id</td>
                              <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, optio cum officia, deserunt exercitationem sit consequatur doloremque dolor laborum debitis blanditiis molestiae minima itaque odio harum iusto consectetur necessitatibus placeat.</td>
                              <td><button class="btn btn-warning">Revisi</button></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Akd</td>
                              <td>https://s.id</td>
                              <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, optio cum officia, deserunt exercitationem sit consequatur doloremque dolor laborum debitis blanditiis molestiae minima itaque odio harum iusto consectetur necessitatibus placeat.</td>
                              <td><button class="btn btn-success">Tuntas</button></td>
                            </tr>
                        </tbody>
                    </table>
                      <div class="container d-flex justify-content-between">
                        <button class="btn btn-primary">Edit Tugas</button>
                        <button class="btn btn-danger">Hapus Tugas</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endfor
            </div>
          </div>
      </div>
  </div>
</section>

@include('layouts/footer')

@endsection