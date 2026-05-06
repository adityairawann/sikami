<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\DetailPenilaian;
use App\Models\Domain;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // ================= HASIL EVALUASI =================
    public function hasil()
    {
        $penilaian = Penilaian::where('user_id', auth()->id())->first();

        if (!$penilaian) {
            return view('laporan.hasil', [
                'hasil' => [],
                'areaKritis' => null
            ]);
        }

        $domains = Domain::all();
        $hasil = [];

        foreach ($domains as $domain) {

            $total = DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                ->where('pertanyaan.id_domain', $domain->id_domain)
                ->sum('nilai');

            $hasil[] = [
                'nama' => $domain->namaDomain,
                'total' => $total
            ];
        }

        // area kritis
        $areaKritis = collect($hasil)->sortBy('total')->first();

        return view('laporan.hasil', compact('hasil', 'areaKritis'));
    }


    // ================= LAPORAN (RINGKASAN) =================
    public function index()
    {
        $penilaian = Penilaian::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->first();

        if (!$penilaian) {
            return view('laporan.index', [
                'periode' => '-',
                'totalSkor' => 0,
                'status' => '-',
                'areaKritis' => ['nama' => '-']
            ]);
        }

        $domains = Domain::all();
        $hasil = [];
        $totalSkor = 0;

        foreach ($domains as $domain) {

            $total = DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                ->where('pertanyaan.id_domain', $domain->id_domain)
                ->sum('nilai');

            $hasil[] = [
                'nama' => $domain->namaDomain,
                'total' => $total
            ];

            $totalSkor += $total;

            $jumlahSoal = DetailPenilaian::where('id_penilaian', $penilaian->id_penilaian)->count();
            $skorMaksimal = $jumlahSoal * 3;

            $persen = ($skorMaksimal > 0) ? ($totalSkor / $skorMaksimal) * 100 : 0;
        }

        // STATUS
        if ($persen >= 80) {
        $status = "Tinggi (Siap)";
        } elseif ($persen >= 50) {
        $status = "Sedang (Cukup)";
        } else {
        $status = "Rendah (Belum Siap)";
        }

        // AREA KRITIS
        $areaKritis = collect($hasil)->sortBy('total')->first();

        // PERIODE
        $periode = date('Y', strtotime($penilaian->tanggal));

        return view('laporan.index', compact('periode', 'totalSkor', 'status', 'areaKritis', 'persen'));
    }
    public function cetakPdf()
{
    $penilaian = Penilaian::where('user_id', auth()->id())
        ->orderBy('tanggal', 'desc')
        ->first();

    if (!$penilaian) {
        return redirect('/laporan')->with('error', 'Belum ada data');
    }

    $domains = Domain::all();
    $hasil = [];
    $totalSkor = 0;

    foreach ($domains as $domain) {

        $total = DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
            ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
            ->where('pertanyaan.id_domain', $domain->id_domain)
            ->sum('nilai');

        $hasil[] = [
            'nama' => $domain->namaDomain,
            'total' => $total
        ];

        $totalSkor += $total;
    }

    // status
    if ($totalSkor >= 80) {
        $status = "Tinggi";
    } elseif ($totalSkor >= 40) {
        $status = "Sedang";
    } else {
        $status = "Rendah";
    }

    $areaKritis = collect($hasil)->sortBy('total')->first();
    $periode = date('Y', strtotime($penilaian->tanggal));

    $pdf = Pdf::loadView('laporan.pdf', compact('periode','totalSkor','status','areaKritis','hasil'));

    return $pdf->download('laporan-sikami.pdf');
}
}