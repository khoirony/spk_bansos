@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Solusi Ideal Positif dan Negatif</h1> <div class="col text-end pe-3">Periode : </div><div class="col-2"><form action="/solusi" method="post"> @csrf <input type="month" class="form-control" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit();"></form></div>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col">
        <h3>D+</h3>
        <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($warga as $w)
            <tr>
              <th scope="row">{{ $no_dp++ }}</th>
              <td>
                {{ $w->nama_warga }}
              </td>
                @foreach ($w->dpositif as $alt)
                <td>
                  {{ $alt->nilai_dpositif }}
                </td>
                @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $warga->links() }}
      </div>
      <div class="col">
        <h3>D-</h3>
        <table class="table table-striped table-hover">
          <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Alternatif</th>
                <th scope="col">Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($warga as $w)
            <tr>
              <th scope="row">{{ $no_dn++ }}</th>
              <td>
                {{ $w->nama_warga }}
              </td>
                @foreach ($w->dnegatif as $alt)
                <td>
                  {{ $alt->nilai_dnegatif }}
                </td>
                @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $warga->links() }}
      </div>
    </div>

</div>

@endsection
