<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;
use App\Models\DetailPenilaian;

class KuesionerController extends Controller
{
    public function index()
    {
        $domain = Domain::with('pertanyaan')->get();
        return view('kuesioner.index', compact('domain'));
    }

    public function simpan(Request $request)
    {
        foreach ($request->jawaban as $id_pertanyaan => $nilai) {
            DetailPenilaian::create([
                'id_pertanyaan' => $id_pertanyaan,
                'nilai' => $nilai
            ]);
        }

        return "Jawaban berhasil disimpan!";
    }
}