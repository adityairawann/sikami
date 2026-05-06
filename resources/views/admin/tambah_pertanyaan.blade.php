@extends('layouts.admin')

@section('content')

<h2>Tambah Pertanyaan</h2>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
    <a href="javascript:history.back()" 
       style="text-decoration:none; font-size:22px; color:black;">
        ←
    </a>

    <h2 style="margin:0;">Tambah Pertanyaan</h2>

</div>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:500px;">

<form action="/admin/pertanyaan/store" method="POST">
    @csrf

    <label>Domain:</label><br>
    <select name="id_domain" style="width:100%; padding:5px;">
        @foreach($domains as $d)
            <option value="{{ $d->id_domain }}">{{ $d->namaDomain }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Pertanyaan:</label><br>
    <textarea name="pertanyaan" style="width:100%; height:100px;"></textarea>
    <br><br>

    <button type="submit" 
        style="background:#e67e22; color:white; padding:8px 15px; border:none; border-radius:5px;">
        Simpan
    </button>

</form>

</div>

@endsection