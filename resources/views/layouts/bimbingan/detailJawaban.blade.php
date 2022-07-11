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
                <h3>Jawaban Tugas {{ $jawaban->tugas->nama_tugas }}</h3>
                <p class="text-subtitle text-muted">oleh {{ $jawaban->santri->nama_santri }}</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('bimbingan') }}">Bimbingan Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Jawaban</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card shadow rounded mb-5">
                    <div class="card-content">
                        <div class="card-body">
                            @include('layouts/massage')
                            <strong>Link Jawaban:</strong>
                            <a href="{{ $jawaban->link_jawaban }}" target="_blank"><p>{{ $jawaban->link_jawaban }}</p></a>
                            <strong>Keterangan Jawaban:</strong>
                            <p>{{ $jawaban->keterangan_jawaban }}</p>
                        </div>
                    </div>
                </div>
                <div class="card shadow rounded">
                    <div class="card-header">
                        <h3>Berikan Penilaian</h3>
                    </div>
                    <div class="card-body">
                        @include('layouts/massage')
                        <form class="form" method="POST"
                          @if ($jawaban->revisi == null)
                            action="{{ route('saveRevisi',$id = $jawaban->id) }}"
                          @else
                            action="{{ route('updateRevisi',$id = $jawaban->revisi->id) }}" 
                          @endif
                            >
                            @csrf
                            @if ($jawaban->revisi != null)
                                @method("put")
                            @endif
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="status_tugas">Status Tugas</label><br>
                                        <select class="selectpicker form-control" id="status_tugas" data-container="body" data-live-search="true" name="status_revisi" title="Pilih Status" data-hide-disabled="true" required>
                                            <option value="Revisi" @if ($jawaban->revisi->status_revisi == "Revisi")
                                                selected
                                            @endif>Revisi</option>
                                            <option value="Tuntas" @if ($jawaban->revisi->status_revisi == "Tuntas")
                                                selected
                                            @endif>Tuntas</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="desc-column">Keterangan Penilaian</label>
                                        <textarea class="form-control" name="keterangan_revisi" placeholder="Tambahkan keterangan ke santri" rows="5" required>@if ($jawaban->revisi != null){{ $jawaban->revisi->keterangan_revisi }}@endif</textarea>
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
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>

@include('layouts/footer')
@endsection