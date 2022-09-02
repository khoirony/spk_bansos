@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Solusi Ideal Positif dan Negatif</h1> <div class="col text-end pe-3">Periode : </div><div class="col-2"><form action="/solusi" method="post"> @csrf <input type="month" class="form-control" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit();"></form></div>
</div>

<div class="container-fluid">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">+-</th>
                @foreach ($kriteria as $k)
                  <th scope="col">{{ $k->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
          @foreach ($positifnegatif as $p)
          <tr>
            <td>
              {{ $p->name }}
            </td>
            @foreach ($kriteria as $k)
            <td>
              <?php 
                $id = 'c'.$k->id;
              ?>
              {{ $p->$id }}
            </td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
    </table><br>

    <div class="row">
      <div class="col">
        <h3>D+</h3>
        <table class="table table-striped table-hover">
          <thead>
              <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($dpositif as $dp)
            <tr>
              <th scope="row">{{ $dp->warga->name }}</th>
              <td>
                {{ $dp->nilai }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $dpositif->links() }}
      </div>
      <div class="col">
        <h3>D-</h3>
        <table class="table table-striped table-hover">
          <thead>
              <tr>
                  <th scope="col">Alternatif</th>
                  <th scope="col">Nilai</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($dnegatif as $dn)
            <tr>
              <th scope="row">{{ $dn->warga->name }}</th>
              <td>
                {{ $dn->nilai }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $dnegatif->links() }}
      </div>
    </div>

</div>

@endsection
