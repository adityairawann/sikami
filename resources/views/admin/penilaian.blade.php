@extends('layouts.admin')

@section('content')

<h2>Data Penilaian</h2>
<p style="color:gray;">Admin > Data Penilaian</p>

<table style="width:100%; border-collapse:separate; border-spacing:0 8px;">
    
    <tr style="background:#e67e22; color:white;">
        <th style="padding:10px;">No</th>
        <th>Periode</th>
        <th>User</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $i => $d)
    <tr style="background:#f4e1d2; text-align:center;">
        <td style="padding:10px;">{{ $i+1 }}</td>
        <td>{{ date('Y', strtotime($d->tanggal)) }}</td>
        <td>{{ $d->user->name ?? '-' }}</td>
        <td>Selesai</td>

       <td>
    <div style="display:flex; gap:5px; justify-content:center;">

        <!-- DETAIL -->
        <a href="/admin/pilih/{{ $d->id_penilaian }}"
           style="background:#e67e22; color:white; padding:5px 10px; border-radius:5px;">
           Detail
        </a>

        <!-- HAPUS -->
        <a href="/admin/penilaian/delete/{{ $d->id_penilaian }}"
           onclick="return confirm('Hapus data ini?')"
           style="background:#c0392b; color:white; padding:5px 10px; border-radius:5px;">
           Hapus
        </a>

    </div>
</td>
        </td>
    </tr>
    @endforeach

</table>

</div>

@endsection