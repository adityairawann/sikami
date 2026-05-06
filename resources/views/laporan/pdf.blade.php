<h2>Laporan Penilaian</h2>

<p>Periode: {{ $periode }}</p>
<p>Total Skor: {{ $totalSkor }}</p>
<p>Status: {{ $status }}</p>
<p>Area Kritis: {{ $areaKritis['nama'] }}</p>

<hr>

<table border="1" width="100%" cellpadding="5">
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