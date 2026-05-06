<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Domain;
use App\Models\Pertanyaan;
use App\Models\Penilaian;
use App\Models\DetailPenilaian;

class PenilaianController extends Controller
{
    // ================= PILIH DOMAIN =================
    public function pilihDomain()
    {
        $domains = Domain::all();

        $penilaian = Penilaian::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->first();

        $sudahIsi = [];

        if ($penilaian) {
            $sudahIsi = DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                ->pluck('pertanyaan.id_domain')
                ->unique()
                ->toArray();
        }

        return view('penilaian.pilih_domain', compact('domains', 'sudahIsi'));
    }

    // ================= TAMPIL PERTANYAAN =================
    public function index($id)
    {
        $pertanyaan = Pertanyaan::where('id_domain', $id)->get();
        return view('penilaian.index', compact('pertanyaan'));
    }

    // ================= SIMPAN JAWABAN =================
  public function store(Request $request)
{
    // ambil penilaian milik user (1 saja)
    $penilaian = Penilaian::where('user_id', auth()->id())->first();

    // kalau belum ada → buat
    if (!$penilaian) {
        $penilaian = Penilaian::create([
            'user_id' => auth()->id(),
            'tanggal' => now()
        ]);
    }

    foreach ($request->jawaban as $id_pertanyaan => $nilai) {
        DetailPenilaian::updateOrCreate(
            [
                'id_penilaian' => $penilaian->id_penilaian,
                'id_pertanyaan' => $id_pertanyaan
            ],
            [
                'id_penilaian' => $penilaian->id_penilaian,
                'nilai' => $nilai
            ]
        );
    }

    return redirect('/penilaian');
}
}