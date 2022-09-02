@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $title }}</h1> <a href="/tambahwarga" class="btn btn-sm btn-primary">Tambah Warga</a>
</div>

<div>
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
    <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama KRT</th>
            <th scope="col">Alamat</th>
            <th scope="col" style="text-align: center;width:130px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($warga as $w)
          <tr>
            <th scope="row">{{ $no++ }}</th>
            <td>
                {{ $w->nama_warga }}
            </td>
            <td>
                {{ $w->alamat_warga }}
            </td>
            <td>
              <a href="/editalternatif/{{ $w->id }}" class="btn btn-sm btn-primary"><span data-feather="file-text"></span></a> <a href="/editwarga/{{ $w->id }}" class="btn btn-sm btn-warning"><span data-feather="edit"></span></a> <a href="/hapuswarga/{{ $w->id }}" class="btn btn-sm btn-secondary"><span data-feather="trash-2"></span></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
{{ $warga->links() }}
@endsection