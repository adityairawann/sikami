<h2>Laporan Penilaian</h2>

<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
    
    <a href="javascript:history.back()" 
       style="text-decoration:none; font-size:22px; color:black;">
        ←
    </a>

    <h2 style="margin:0;">Tambah Pertanyaan</h2>

</div>

<p>User: {{ $penilaian->user->name }}</p>
<p>Total Skor: {{ $totalSkor }}</p>
<p>Area Kritis: {{ $areaKritis['nama'] }}</p>

<table border="1" width="100%">
    <tr>
        <th>No</th>
        <th>Domain</th>
        <th>Skor</th>
    </tr>

    @foreach($hasil as $i => $h)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $h['nama'] }}</td>
        <td>{{ $h['total'] }}</td>
    </tr>
    @endforeach
</table>