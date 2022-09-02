@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $title }}</h1>
</div>

<div class="container pb-5">
    <form action="/substore" method="POST">
        @csrf
        <input type="hidden" id="id_kriteria" name="id_kriteria" value="{{ $id }}">

        <div class="mb-3">
            <label class="mb-2 fw-bold">Kriteria : </label> {{ $kriteria->nama_kriteria }} <br>
            <label class="mb-2 fw-bold">Atribut : </label> {{ $kriteria->atribut_kriteria }} <br>
        </div>
        
        <div class="mb-3">
            <label for="nama_sub_kriteria" class="mb-2 fw-bold">Nama Sub Kriteria</label>
            <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria">
        </div>

        <div class="mb-3">
            <label for="bobot_sub_kriteria" class="mb-2 fw-bold">Bobot Sub Kriteria</label>
            <input type="text" class="form-control" id="bobot_sub_kriteria" name="bobot_sub_kriteria" placeholder="1-9">
        </div>

        <button type="submit" class="btn btn-primary px-5 text-center">Submit</button>
    </form>
</div>

@endsection
