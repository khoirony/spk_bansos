@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Normalisasi Terbobot</h1> <div class="col text-end pe-3">Periode : </div><div class="col-2"><form action="/terbobot" method="post"> @csrf <input type="month" class="form-control" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit();"></form></div>
</div>

<div class="container-fluid">
    <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            @foreach ($kriteria as $k)
              <th scope="col">{{ $k->nama_kriteria }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($warga as $w)
          <tr>
            <th scope="row">{{ $no++ }}</th>
            <td>
              {{ $w->nama_warga }}
            </td>
              @foreach ($kriteria as $k)
                @foreach ($terbobot as $t)
                  @if($w->id == $t->id_warga && $k->id == $t->id_kriteria)
                    <td>
                    {{ $t->nilai_terbobot }}
                    </td>
                  @endif
                @endforeach
              @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
{{ $warga->links() }}
@endsection