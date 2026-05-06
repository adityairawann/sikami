@extends('layouts.admin')

@section('content')

<h2>Domain Indeks KAMI</h2>
<p style="color:gray;">Admin > Domain Indeks KAMI</p>

<div style="background:#f5f5f5; padding:20px; border-radius:5px; width:800px; box-shadow:0 0 5px #ccc;">

    <table style="width:100%; border-collapse:separate; border-spacing:0 8px;">
        
        <tr style="background:#e67e22; color:white;">
            <th style="padding:10px;">No</th>
            <th>Domain</th>
        </tr>

        @foreach($domains as $i => $d)
        <tr style="background:#f4e1d2; text-align:center;">
            <td style="padding:10px;">{{ $i+1 }}</td>
            <td>{{ $d->namaDomain }}</td>
        </tr>
        @endforeach

    </table>

</div>

@endsection