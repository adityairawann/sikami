@extends('layouts.app')

@section('content')

<h2>Pilih Domain Penilaian</h2>

@foreach ($domains as $d)

    @if(in_array($d->id_domain, $sudahIsi))
        <div style="background:lightgreen; padding:10px; margin-bottom:10px;">
            {{ $d->namaDomain }} ✔ Sudah diisi
        </div>
    @else
        <a href="{{ route('penilaian.domain', $d->id_domain) }}"
           style="display:block; background:orange; color:white; padding:10px; margin-bottom:10px;">
            {{ $d->namaDomain }}
        </a>
    @endif

@endforeach

@endsection