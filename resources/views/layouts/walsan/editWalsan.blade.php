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
                <h3>Edit Wali santri</h3>
                <p class="text-subtitle text-muted">Antum bisa mengedit data Wali santri disini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Wali santri</li>
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
                            <form class="form" method="POST" action="{{ route('saveWalsan') }}">
                                @csrf
                                @method("put")
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama-column">Nama Wali Santri</label>
                                            <input type="text" id="nama-column" class="form-control"
                                                placeholder="Masukkan Nama Wali Santri" name="nama_walsan" value="{{ $data->nama_walsan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-column">Email Wali Santri</label>
                                            <input type="email" id="email-column" class="form-control"
                                                placeholder="Masukkan Email" name="email_walsan" value="{{ $data->email_walsan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon-column">Telepon Wali Santri</label>
                                            <input type="text" id="telepon-column" class="form-control"
                                                name="telepon_walsan" placeholder="Masukkan Telepon" value="{{ $data->telepon_walsan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon-column">Nama Santri</label>
                                            <select class="selectpicker form-control" data-container="body" data-live-search="true" name="santri_nisn" title="Pilih Nama Santri" data-hide-disabled="true" required>
                                                @foreach ($santri as $item)
                                                    @if ($item->nisn == $data->santri_nisn)
                                                        <option value="{{ $item->nisn }}" selected>{{ $item->nama_santri }}</option>
                                                    @else
                                                        <option value="{{ $item->nisn }}">{{ $item->nama_santri }}</option>
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