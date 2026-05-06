@extends('layouts.admin')

@section('content')

<h2>Edit Pertanyaan</h2>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
    <a href="javascript:history.back()" 
       style="text-decoration:none; font-size:22px; color:black;">
        ←
    </a>

    <h2 style="margin:0;">Tambah Pertanyaan</h2>

</div>

<form action="/admin/pertanyaan/update/{{ $data->id_pertanyaan }}" method="POST">
    @csrf

    Domain:<br>
    <select name="id_domain">
        @foreach($domains as $d)
            <option value="{{ $d->id_domain }}"
                {{ $data->id_domain == $d->id_domain ? 'selected' : '' }}>
                {{ $d->namaDomain }}
            </option>
        @endforeach
    </select><br><br>

    Pertanyaan:<br>
    <textarea name="pertanyaan">{{ $data->pertanyaan }}</textarea><br><br>

    <button type="submit">Update</button>
</form>

@endsection