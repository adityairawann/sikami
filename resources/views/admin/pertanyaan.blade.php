@extends('layouts.admin')

@section('content')

<h2>Kelola Pertanyaan</h2>
<p style="color:gray;">Admin > Kelola Pertanyaan</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px; box-shadow:0 0 5px #ccc;">

    <!-- DROPDOWN DOMAIN -->
    <form method="GET" action="/admin/pertanyaan" style="margin-bottom:15px;">
        Domain:
        <select name="id_domain" onchange="this.form.submit()" style="padding:5px;">
            <option value="">-- Semua Domain --</option>
            @foreach($domains as $d)
                <option value="{{ $d->id_domain }}" 
                    {{ request('id_domain') == $d->id_domain ? 'selected' : '' }}>
                    {{ $d->namaDomain }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- TABEL -->
    <table style="width:100%; border-collapse:separate; border-spacing:0 8px;">
        
        <tr style="background:#e67e22; color:white;">
            <th>No</th>
            <th>Domain</th>
            <th>Pertanyaan</th>
            <th>Aksi</th>
        </tr>

        @foreach($pertanyaan as $i => $p)
        <tr style="background:#f4e1d2; text-align:center;">
            <td>{{ $i+1 }}</td>
            <td>{{ $p->domain->namaDomain ?? '-' }}</td>
            <td>{{ $p->pertanyaan }}</td>

            <td>
    <div style="display:flex; gap:8px; justify-content:center;">

        <a href="/admin/pertanyaan/edit/{{ $p->id_pertanyaan }}"
           style="background:#e67e22; color:white; padding:6px 10px; border-radius:5px; text-decoration:none;">
           Edit
        </a>

        <a href="/admin/pertanyaan/delete/{{ $p->id_pertanyaan }}"
           onclick="return confirm('Yakin hapus?')"
           style="background:#d35400; color:white; padding:6px 10px; border-radius:5px; text-decoration:none;">
           Hapus
        </a>
     </td>
  </tr>
        @endforeach

    </table>

    <!-- BUTTON TAMBAH -->
    <div style="margin-top:15px; text-align:right;">
        <a href="/admin/pertanyaan/tambah"
           style="background:#e67e22; color:white; padding:10px 15px; border-radius:5px;">
           + Tambah Pertanyaan
        </a>
    </div>

</div>

@endsection