@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Manage Alternatif</h1>  <div class="col text-end pe-3">Periode : </div><div class="col-2"><form action="/editalternatif/{{ $warga->id }}" method="post"> @csrf <input type="month" class="form-control" id="periode" name="periode" value="{{ $periode }}" onchange="this.form.submit();"></form></div>
</div>

<div class="container pb-5">
    <form action="/updatealternatif/{{ $warga->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="periode" name="periode" value="{{ $periode }}"> 

        <div class="mb-3">
            <label class="mb-2 fw-bold">Nama : </label> {{ $warga->nama_warga }} <br>
            <label class="mb-2 fw-bold">Alamat : </label> {{ $warga->alamat_warga }} <br>
        </div>

        @foreach ($kriteria as $k)
            @if($k->subkriteria == '[]')
            <div class="mb-3">
                <label for="nilai_alternatif{{ $k->id }}" class="mb-2 fw-bold">{{ $k->nama_kriteria }}</label>
                @if($cekalternatif == 0)
                <input type="text" class="form-control" id="nilai_alternatif{{ $k->id }}" name="nilai_alternatif{{ $k->id }}">
                @else
                    <input type="text" class="form-control" id="nilai_alternatif{{ $k->id }}" name="nilai_alternatif{{ $k->id }}" value="{{ $k->nilai_alternatif }}">
                @endif
            </div>
            @else
            <div class="mb-3">
                <label for="nilai_alternatif{{ $k->id }}" class="mb-2 fw-bold">{{ $k->nama_kriteria }}</label> <br>
                @foreach ($k->subkriteria as $sub)
                    @if($cekalternatif == 0)
                    <input class="form-check-input" type="radio" name="nilai_alternatif{{ $k->id }}" id="nilai_alternatif{{ $k->id }}" value="{{ $sub->bobot_sub_kriteria }}">
                    @else
                        <input class="form-check-input" type="radio" name="nilai_alternatif{{ $k->id }}" id="nilai_alternatif{{ $k->id }}" value="{{ $sub->bobot_sub_kriteria }}" @if($k->nilai_alternatif == $sub->bobot_sub_kriteria) checked @endif>
                    @endif
                    <label class="form-check-label me-3" for="nilai_alternatif{{ $k->id }}">
                        <b>{{ $sub->bobot_sub_kriteria }}.</b> {{ $sub->nama_sub_kriteria }}
                    </label>
                @endforeach
            </div>
            @endif
        @endforeach

        <button type="submit" class="btn btn-primary px-5 text-center">Submit</button>
    </form>
</div>

@endsection
