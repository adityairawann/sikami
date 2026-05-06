<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\DetailPenilaian;
use App\Models\Domain;

class DashboardController extends Controller
{
public function index()
{
    $userId = auth()->user()->id;

    // ambil penilaian terakhir user
    $penilaian = \App\Models\Penilaian::where('user_id', $userId)
        ->orderBy('tanggal', 'desc')
        ->first();

    $status = '-';

    if ($penilaian) {

        $domains = \App\Models\Domain::all();

        $totalSkor = 0;
        $hasil = [];

        foreach ($domains as $domain) {

            $total = \App\Models\DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                ->where('pertanyaan.id_domain', $domain->id_domain)
                ->sum('nilai');

            $hasil[] = $total;
            $totalSkor += $total;
        }

        // 🔥 HITUNG PERSENTASE (SAMA SEPERTI ADMIN)
        $totalMaks = count($hasil) * 20;
        $persentase = ($totalMaks > 0) ? ($totalSkor / $totalMaks) * 100 : 0;

        // 🔥 STATUS (SAMA PERSIS)
        if ($persentase < 60) {
            $status = 'Rendah';
        } elseif ($persentase < 80) {
            $status = 'Sedang';
        } else {
            $status = 'Tinggi';
        }
    }

    return view('dashboard', compact('penilaian', 'status'));
}
}