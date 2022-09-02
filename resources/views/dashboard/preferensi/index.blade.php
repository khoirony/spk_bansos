@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Preferensi</h1> <div class="col text-end pe-3">Periode : </div><div class="col-2"><form action="/preferensi" method="post"> @csrf <input type="month" class="form-control" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit();"></form></div>
</div>

<div class="container-fluid">
  <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Preferensi</th>
            <th scope="col" width="25%">
              <div class="row">
                <div class="col-3">Rangking</div>
                <div class="col-1">
                  <form action="/preferensi" method="post">
                    @csrf
                    @if($sort == 0)
                    <input type="hidden" id="sort" name="sort" value="1">
                    <input type="hidden" id="periode" name="periode" value="{{ $periode }}">
                    @elseif($sort == 1)
                    <input type="hidden" id="sort" name="sort" value="2">
                    <input type="hidden" id="periode" name="periode" value="{{ $periode }}">
                    @endif
                    <button type="submit" class="border-0 bg-white w-25">
                      <span data-feather="chevrons-up"></span>
                    </button>
                  </form>
                </div>
              </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($preferensi as $p)
            <tr>
              <th scope="row">{{ $p->warga->name }}</th>
              <td>
                {{ $p->warga->alamat }}
              </td>
              <td>
                {{ $p->nilai }}
              </td>
              <td>
                {{ $p->rangking }}
              </td>
            </tr>
            @endforeach
    </tbody>
</table>
</div>
    
@endsection