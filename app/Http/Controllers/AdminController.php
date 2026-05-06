<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pertanyaan;
use App\Models\Penilaian;
use App\Models\Domain;
use App\Models\DetailPenilaian;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        $totalUser = User::count();
        $totalPertanyaan = Pertanyaan::count();
        $totalPenilaian = Penilaian::count();

        $penilaianTerbaru = Penilaian::orderBy('tanggal', 'desc')->first();

        return view('admin.dashboard', compact(
            'totalUser',
            'totalPertanyaan',
            'totalPenilaian',
            'penilaianTerbaru'
        ));
    }

    // ================= DATA PENILAIAN =================
    public function penilaian()
    {
        $data = Penilaian::with('user')
    ->whereNotNull('user_id') // 🔥 ini yang penting
    ->orderBy('tanggal', 'desc')
    ->get();

        return view('admin.penilaian', compact('data'));
    }
    public function deletePenilaian($id)
{
    // 🔥 hapus detail dulu
    \App\Models\DetailPenilaian::where('id_penilaian', $id)->delete();

    // baru hapus penilaian
    \App\Models\Penilaian::findOrFail($id)->delete();

    return redirect('/admin/penilaian');
}

    // ================= PILIH USER =================
    public function pilih($id)
    {
        session(['penilaian_id' => $id]);

        return redirect('/admin/hasil');
    }
    // ================= KELOLA USER =================
public function users()
{
    $users = \App\Models\User::where('role', '!=', 'admin')->get();

    return view('admin.users', compact('users'));
}
// EDIT
public function editUser($id)
{
    $user = \App\Models\User::findOrFail($id);
    return view('admin.edit_user', compact('user'));
}

// UPDATE
public function updateUser($id, \Illuminate\Http\Request $request)
{
    $user = \App\Models\User::findOrFail($id);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;
    $user->save();

    return redirect('/admin/users');
}

// DELETE
public function deleteUser($id)
{
    \App\Models\User::findOrFail($id)->delete();
    return redirect('/admin/users');
}

// ================= DOMAIN =================
public function domain()
{
    $domains = \App\Models\Domain::all();

    return view('admin.domain', compact('domains'));
}

// ================= PERTANYAAN =================
public function pertanyaan(\Illuminate\Http\Request $request)
{
    $domains = \App\Models\Domain::all();

    $query = \App\Models\Pertanyaan::with('domain');

    if ($request->id_domain) {
        $query->where('id_domain', $request->id_domain);
    }

    $pertanyaan = $query->get();

    return view('admin.pertanyaan', compact('pertanyaan', 'domains'));
}


// TAMBAH
public function tambahPertanyaan()
{
    $domains = \App\Models\Domain::all();
    return view('admin.tambah_pertanyaan', compact('domains'));
}

// SIMPAN
public function storePertanyaan(\Illuminate\Http\Request $request)
{
    \App\Models\Pertanyaan::create([
        'id_domain' => $request->id_domain,
        'pertanyaan' => $request->pertanyaan
    ]);

    return redirect('/admin/pertanyaan');
}

// EDIT
public function editPertanyaan($id)
{
    $data = \App\Models\Pertanyaan::findOrFail($id);
    $domains = \App\Models\Domain::all();

    return view('admin.edit_pertanyaan', compact('data', 'domains'));
}

// UPDATE
public function updatePertanyaan($id, \Illuminate\Http\Request $request)
{
    $data = \App\Models\Pertanyaan::findOrFail($id);

    $data->id_domain = $request->id_domain;
    $data->pertanyaan = $request->pertanyaan;
    $data->save();

    return redirect('/admin/pertanyaan');
}

// DELETE
public function deletePertanyaan($id)
{
    \App\Models\Pertanyaan::findOrFail($id)->delete();
    return redirect('/admin/pertanyaan');
}

    // ================= HASIL EVALUASI =================
   public function hasil(\Illuminate\Http\Request $request)
{
    $users = \App\Models\User::where('role', '!=', 'admin')->get();

    $penilaian = null;
    $hasil = [];
    $areaKritis = null;
    $totalSkor = 0;
    $persentase = 0;
    $status = '-';

    if ($request->id_user) {

        $penilaian = \App\Models\Penilaian::where('user_id', $request->id_user)
            ->orderBy('tanggal', 'desc')
            ->first();

        if ($penilaian) {

            $domains = \App\Models\Domain::all();

            foreach ($domains as $domain) {

                $total = \App\Models\DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                    ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                    ->where('pertanyaan.id_domain', $domain->id_domain)
                    ->sum('nilai');

                $hasil[] = [
                    'nama' => $domain->namaDomain,
                    'total' => $total
                ];

                $totalSkor += $total;
            }

            // 🔥 HITUNG PERSENTASE
            $totalMaks = count($hasil) * 20; // asumsi max 20 per domain
            $persentase = ($totalMaks > 0) ? ($totalSkor / $totalMaks) * 100 : 0;

            // 🔥 STATUS (SAMA DENGAN USER)
            if ($persentase < 60) {
                $status = 'Rendah';
            } elseif ($persentase < 80) {
                $status = 'Sedang';
            } else {
                $status = 'Tinggi';
            }

            $areaKritis = collect($hasil)->sortBy('total')->first();
        }
    }

    return view('admin.hasil', compact(
        'users',
        'penilaian',
        'hasil',
        'areaKritis',
        'totalSkor',
        'persentase',
        'status'
    ));
}
        // ================= LAPORAN =================
public function laporan(\Illuminate\Http\Request $request)
{
    $users = \App\Models\User::where('role', '!=', 'admin')->get();

    $penilaian = null;
    $hasil = [];
    $areaKritis = null;
    $totalSkor = 0;
    $status = '-';

    if ($request->id_user) {

        $penilaian = \App\Models\Penilaian::where('user_id', $request->id_user)
            ->orderBy('tanggal', 'desc')
            ->first();

        if ($penilaian) {

            $domains = \App\Models\Domain::all();

            foreach ($domains as $domain) {

                $total = \App\Models\DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
                    ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
                    ->where('pertanyaan.id_domain', $domain->id_domain)
                    ->sum('nilai');

                $hasil[] = [
                    'nama' => $domain->namaDomain,
                    'total' => $total
                ];

                $totalSkor += $total;
            }

            $areaKritis = collect($hasil)->sortBy('total')->first();

            // STATUS
            if ($totalSkor < 20) {
                $status = 'Rendah';
            } elseif ($totalSkor < 50) {
                $status = 'Sedang';
            } else {
                $status = 'Tinggi';
            }
        }
    }

    return view('admin.laporan', compact(
        'users',
        'penilaian',
        'hasil',
        'areaKritis',
        'totalSkor',
        'status'
    ));
}

// ================= PDF =================
public function cetakPdf(\Illuminate\Http\Request $request)
{
    $id = $request->id_user;

    $penilaian = \App\Models\Penilaian::where('user_id', $id)
        ->orderBy('tanggal', 'desc')
        ->first();

    $domains = \App\Models\Domain::all();
    $hasil = [];
    $totalSkor = 0;

    foreach ($domains as $domain) {

        $total = \App\Models\DetailPenilaian::join('pertanyaan', 'detail_penilaian.id_pertanyaan', '=', 'pertanyaan.id_pertanyaan')
            ->where('detail_penilaian.id_penilaian', $penilaian->id_penilaian)
            ->where('pertanyaan.id_domain', $domain->id_domain)
            ->sum('nilai');

        $hasil[] = [
            'nama' => $domain->namaDomain,
            'total' => $total
        ];

        $totalSkor += $total;
    }

    $areaKritis = collect($hasil)->sortBy('total')->first();

    // 🔥 INI YANG MEMBUAT PDF
    $pdf = Pdf::loadView('admin.laporan_pdf', compact(
        'penilaian',
        'hasil',
        'areaKritis',
        'totalSkor'
    ));

    return $pdf->download('laporan_penilaian.pdf');
}
}