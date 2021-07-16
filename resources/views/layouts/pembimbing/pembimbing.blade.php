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
                <h3>Data Pembimbing PKL</h3>
                <p class="text-subtitle text-muted">list pembimbing yang mendampingi santri ketika pkl</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembimbing</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('addPembimbing') }}"><button class="btn btn-outline-primary">Tambah Pembimbing</button></a>
            </div>
            <div class="card-body">
                @include('layouts/massage')
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembimbing</th>
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
                                <td>{{ $item->nama_pembimbing }}</td>
                                <td>{{ $item->email_pembimbing }}</td>
                                <td>{{ $item->telepon_pembimbing }}</td>
                                <td>
                                    <a href="{{ route('editPembimbing',$id = $item->id) }}"><button class="btn btn-primary mb-1 float-left mr-1">Edit</button></a>
                                    <form action="{{ route('deletePembimbing',$id = $item->id) }}" method="post">
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

@endsection