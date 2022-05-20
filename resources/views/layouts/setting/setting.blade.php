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
                <h3>Pengaturan</h3>
                <p class="text-subtitle text-muted">Antum mengubah - ubah peraturan - perturan di website ini</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
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
                            <form class="form" method="POST" action="{{ route('savePengaturan') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-3">
                                            <label for="angkatan">Pilih Angkatan Aktif</label>
                                        </div>
                                        <div class="col-2">
                                            <select class="form-control" id="angkatan" name="angkatan" placeholder="Pilih Angkatan" required>
                                                @if ($data == null)
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                @else
                                                    @for ($i = 1; $i <= 20; $i++)
                                                        <option value="{{ $i }}" @if ($angkatan->isi_pengaturan == $i)
                                                            selected
                                                        @endif>{{ $i }}</option>
                                                    @endfor
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12 d-flex">
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