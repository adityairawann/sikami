@extends('layouts.app')

@section('content')

<h2>Kuesioner</h2>

<form action="{{ route('penilaian.store') }}" method="POST">
@csrf

@foreach ($pertanyaan as $p)
<div style="margin-bottom:20px;">
    <b>{{ $p->pertanyaan }}</b><br>

    <label>
        <input type="radio" name="jawaban[{{ $p->id_pertanyaan }}]" value="3" required> Ya
    </label>

    <label>
        <input type="radio" name="jawaban[{{ $p->id_pertanyaan }}]" value="2"> Sebagian
    </label>

    <label>
        <input type="radio" name="jawaban[{{ $p->id_pertanyaan }}]" value="1"> Tidak
    </label>
</div>
@endforeach

<button type="submit">Simpan</button>

</form>

@endsection