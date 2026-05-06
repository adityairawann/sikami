@extends('layouts.admin')

@section('content')

<h2>Kelola User</h2>
<p style="color:gray;">Admin > Kelola User</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px; box-shadow:0 0 5px #ccc;">

    <table style="width:100%; border-collapse:separate; border-spacing:0 8px;">
        
        <tr style="background:#e67e22; color:white;">
            <th style="padding:10px;">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        @foreach($users as $i => $u)
        <tr style="background:#f4e1d2; text-align:center;">
            <td>{{ $i+1 }}</td>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>

            <td>
                <a href="/admin/users/edit/{{ $u->id }}"
                   style="background:#e67e22; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
                   Edit
                </a>

                <a href="/admin/users/delete/{{ $u->id }}"
                   onclick="return confirm('Yakin hapus user ini?')"
                   style="background:#d35400; color:white; padding:6px 12px; border-radius:5px; text-decoration:none;">
                   Hapus
                </a>
            </td>
        </tr>
        @endforeach

    </table>

</div>

@endsection