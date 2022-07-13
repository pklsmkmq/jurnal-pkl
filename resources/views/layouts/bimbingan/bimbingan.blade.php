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
                @if (auth()->user()->status == "pembimbing")
                  <p class="text-subtitle text-muted">Antum dapat memberikan tugas laporan dan mengkoreksi laporan disini</p>    
                @elseif (auth()->user()->status == "santri")
                  <p class="text-subtitle text-muted">Antum dapat melakukan bimbingan disini</p>
                @else
                  <p class="text-subtitle text-muted">Antum dapat melihat bimbingan santri disini</p>
                @endif
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
      @if (auth()->user()->status == "pembimbing")
        <div class="card-header">
          <a href="{{ route('addTugas') }}"><button class="btn btn-success">Tambah Tugas Laporan</button></a>
        </div>
      @endif
      @if (auth()->user()->status == "pembimbing" || auth()->user()->status == "admin")
        <div class="card-body">
            @include('layouts/massage')
            @if ($jumlah > 0)
              <div class="container">
                <div class="accordion" id="accordionExample">
                  @php
                      $nmr = 1;
                  @endphp
                  @foreach ($data as $item)
                    @php
                        $nmr++;
                    @endphp
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading{{ $nmr }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $nmr }}" aria-expanded="false" aria-controls="collapse{{ $nmr }}">
                          @if (auth()->user()->status == "admin")
                            {{ $item->pembimbing->nama_pembimbing }} ||     
                          @endif
                          {{ $item->nama_tugas }}
                        </button>
                      </h2>
                      <div id="collapse{{ $nmr }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $nmr }}" data-bs-parent="#accordionExample">
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
                              @if (count($item->jawaban) > 0)
                              @php
                                  $nomor = 1;
                              @endphp
                                  @foreach ($item->jawaban as $key)
                                    <tr>
                                      <td>{{ $nomor }}</td>
                                      <td>{{ $key->santri->nama_santri }}</td>
                                      <td>{{ $key->link_jawaban }}</td>
                                      <td>{{ $key->keterangan_jawaban }}</td>
                                      @if (auth()->user()->status == "pembimbing")
                                        @if ($key->revisi == null)
                                          <td><a href="{{ route('detailJawaban',$id = $key->id) }}"><button class="btn btn-outline-primary">Belum Diperiksa</button></a></td>
                                        @elseif($key->revisi->status_revisi == "Revisi")
                                          <td><a href="{{ route('detailJawaban',$id = $key->id) }}"><button class="btn btn-warning">Revisi</button></a></td>
                                        @else
                                          <td><a href="{{ route('detailJawaban',$id = $key->id) }}"><button class="btn btn-success">Tuntas</button></a></td>
                                        @endif
                                      @else
                                        @if ($key->revisi == null)
                                          <td><button class="btn btn-outline-primary">Belum Diperiksa</button></td>
                                        @elseif($key->revisi->status_revisi == "Revisi")
                                          <td><button class="btn btn-warning">Revisi</button></td>
                                        @else
                                          <td><button class="btn btn-success">Tuntas</button></td>
                                        @endif
                                      @endif
                                    </tr>
                                  @php
                                      $nomor++;
                                  @endphp
                                  @endforeach
                              @else
                                  <tr>
                                    <td colspan="5"><center><strong>DATA KOSONG</strong></center></td>
                                  </tr>
                              @endif
                                
                            </tbody>
                            {{-- <td><button class="btn btn-warning">Revisi</button></td>
                                  <td><button class="btn btn-success">Tuntas</button></td> --}}
                        </table>
                          <div class="container d-flex justify-content-between">
                            @if (auth()->user()->status == "pembimbing")
                              <a href="{{ route('editTugas',$id = $item->id) }}"><button class="btn btn-primary">Edit Tugas</button></a>
                              <form action="{{ route('deleteTugas',$id = $item->id) }}" method="post">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger">Hapus Tugas</button>
                              </form>
                            @else
                              <a href="{{ route('showTugas',$id = $item->id) }}"><button class="btn btn-secondary">Lihat Tugas</button></a>
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @else
              <center><h3>Data Kosong</h3></center>
            @endif
        </div>
      @else
        <div class="card-body">
          @include('layouts/massage')
          <table class="table table-striped" id="table1">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Tugas</th>
                      <th>Batas Tugas</th>
                      <th>Status Tugas</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @php
                  $nomor = 0;
                @endphp
                  @if ($data)
                      @foreach ($data as $item)
                          @php
                              $nomor++;
                          @endphp
                          <tr>
                              <td>{{ $nomor }}</td>
                              <td>{{ $item->nama_tugas }}</td>
                              <td>{{ str_replace(" ", " | ",$item->batas_pengumpulan_tugas) }}</td>
                              <td>
                                @if ($item->jawaban != null)
                                  Sudah DiKumpulkan
                                @else
                                  Belum Dikerjakan
                                @endif
                              </td>
                              <td>
                                <a href="{{ route('showTugas',$id = $item->id) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                @if (auth()->user()->status == "santri")
                                  @if ($item->jawaban != null)
                                  <a href="{{ route('editJawaban',$id = $item->jawaban->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Ubah Jawaban</button></a>
                                  @else
                                    <a href="{{ route('addJawaban',$id = $item->id) }}"><button class="btn btn-danger mb-1 float-left mr-1">Kerjakan</button></a>
                                  @endif
                                @endif
                                  {{-- <a href="{{ route('jurnalDetail',$id = $item->id) }}"><button class="btn btn-secondary mb-1 float-left mr-1">Lihat Detail</button></a>
                                  @if (auth()->user()->status == "santri")
                                      <a href="{{ route('jurnalEdit',$id = $item->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                  @endif --}}
                              </td>
                          </tr>
                      @endforeach
                  @else
                      <tr>
                          <td colspan="6"><center>Data Kosong</center></td>
                      </tr>
                  @endif
              </tbody>
          </table>
        </div>
      @endif
  </div>
</section>

@include('layouts/footer')

@endsection