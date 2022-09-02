@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Kriteria</h1> <a href="/tambahkriteria" class="btn btn-sm btn-primary">Tambah Data</a>
</div>

<div id="accordion">
        @if(session()->has('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('loginError'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('loginError') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

    <div class="card">
        <div class="d-flex bg-secondary text-white fw-bold">
            <div class="d-flex col-10">
                <div class="col-1 p-3">
                    Kode
                </div>
                <div class="col-4 p-3">
                    Nama Kriteria
                </div>
                <div class="col-4 p-3">
                    Atribut Kriteria
                </div>
                <div class="col-3 p-3">
                    Bobot Kriteria
                </div>
            </div>
            <div class="col-2 p-3">
                Aksi
            </div>
        </div>
    </div>
    @foreach ($kriteria as $k)
    <div class="card border-2 border-bottom border-white">
        <div class="d-flex bg-light">
            <a class="d-flex text-decoration-none text-dark col-10" data-bs-toggle="collapse" href="#id{{ $k->id }}">
                <div class="col-1 p-3">
                    C{{ $no++ }}
                </div>
                <div class="col-4 p-3">
                    {{ $k->nama_kriteria }}
                </div>
                <div class="col-4 p-3">
                    {{ $k->atribut_kriteria }}
                </div>
                <div class="col-3 p-3">
                    {{ $k->bobot_kriteria }}
                </div>
            </a>
            <div class="col-2 p-3">
                <a href="/tambahsubkriteria/{{ $k->id }}" class="btn btn-sm btn-primary"><span data-feather="plus"></span></a> <a href="/editkriteria/{{ $k->id }}" class="btn btn-sm btn-warning"><span data-feather="edit"></span></a> <a href="/hapuskriteria/{{ $k->id }}" class="btn btn-sm btn-secondary"><span data-feather="trash-2"></span></a>
            </div>
        </div>
        <div id="id{{ $k->id }}" class="collapse" data-bs-parent="#accordion">
            <div class="card-body pt-0">
                @if($k->subkriteria == '[]')
                    <div class="card text-center border-0 py-3">
                        -Tidak Ada Sub Kriteria-
                    </div>
                @else
                    <div class="card">
                        <div class="d-flex bg-success text-decoration-none fw-bold text-white border-0">
                            <div class="col-4 p-3">
                                Nama Sub Kriteria
                            </div>
                            <div class="col-6 p-3">
                                Bobot Sub Kriteria
                            </div>
                            <div class="col-2 p-3">
                                Aksi
                            </div>
                        </div>
                    </div>
                    @foreach ($k->subkriteria as $sub)
                    <div class="d-flex bg-white text-decoration-none text-dark border-top">
                        <div class="col-4 p-3">
                            {{ $sub->nama_sub_kriteria }}
                        </div>
                        <div class="col-6 p-3">
                            {{ $sub->bobot_sub_kriteria }}
                        </div>
                        <div class="col-2 p-3">
                            <a href="/subedit/{{ $sub->id }}" class="btn btn-sm btn-warning"><span data-feather="edit"></span></a> <a href="/subhapus/{{ $sub->id }}" class="btn btn-sm btn-secondary"><span data-feather="trash-2"></span></a>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection