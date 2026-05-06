@extends('layouts.admin')

@section('content')

<h2>Edit User</h2>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
    <a href="javascript:history.back()" 
       style="text-decoration:none; font-size:22px; color:black;">
        ←
    </a>

    <h2 style="margin:0;">Tambah Pertanyaan</h2>

</div>

<form action="/admin/users/update/{{ $user->id }}" method="POST">
    @csrf

    Nama:<br>
    <input type="text" name="name" value="{{ $user->name }}"><br><br>

    Email:<br>
    <input type="text" name="email" value="{{ $user->email }}"><br><br>

    Role:<br>
    <select name="role">
        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

@endsection