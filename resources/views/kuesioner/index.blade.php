@extends('layout.main')

@section('content')

<h2>Kuesioner</h2>

<form method="POST" action="/kuesioner/simpan">
    @csrf

    @foreach($domain as $d)
        <h3>{{ $d->namaDomain }}</h3>
        <h3>Domain: {{ $domain }}</h3>

        @foreach($d->pertanyaan as $p)
            <p>{{ $p->pertanyaan }}</p>

            <label>
                <input type="radio" name="jawaban[{{ $p->id }}]" value="2"> Ya
            </label>

            <label>
                <input type="radio" name="jawaban[{{ $p->id }}]" value="1"> Sebagian
            </label>

            <label>
                <input type="radio" name="jawaban[{{ $p->id }}]" value="0"> Tidak
            </label>

            <br><br>
        @endforeach

    @endforeach

    <button type="submit">Simpan Jawaban</button>
</form>

@endsection