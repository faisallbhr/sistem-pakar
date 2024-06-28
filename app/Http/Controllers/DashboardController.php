<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $gejala = DB::table('gejalas')->count();
        $kondisi = DB::table('kondisis')->count();
        $depresi = DB::table('depresis')->count();
        $keputusan = DB::table('keputusans')->count();
        $diagnosa = DB::table('diagnosas')->count();
        $admin = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('roles.name', 'guru')
            ->count();

        $diagnosaSiswa = DB::table('diagnosas')
            ->where('user_id', Auth::user()->id)
            ->count();

        $dataForChart = [];

        if (!Auth::user()->hasRole('guru')) {
            $dataDiagnosaSiswa = DB::table('diagnosas')
                ->select(
                    'diagnosas.persentase',
                    'diagnosas.created_at',
                    'depresis.deskripsi'
                )
                ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
                ->where('diagnosas.user_id', Auth::user()->id)
                ->get();

            foreach ($dataDiagnosaSiswa as $item) {
                $tanggal = date('d-m-Y', strtotime($item->created_at));
                switch ($item->deskripsi) {
                    case 'Tidak Depresi':
                        $kategoriDepresi = 1;
                        break;
                    case 'Gangguan Mood':
                        $kategoriDepresi = 2;
                        break;
                    case 'Depresi Ringan':
                        $kategoriDepresi = 3;
                        break;
                    case 'Depresi Sedang':
                        $kategoriDepresi = 4;
                        break;
                    case 'Depresi Berat':
                        $kategoriDepresi = 5;
                        break;
                    default:
                        $kategoriDepresi = 0;
                }
                $dataForChart[] = [
                    'tanggal' => $tanggal,
                    'kategoriDepresi' => $kategoriDepresi,
                    'persentase' => $item->persentase
                ];
            }
        }

        return view('pages/dashboard/dashboard', compact('gejala', 'kondisi', 'depresi', 'keputusan', 'diagnosa', 'admin', 'diagnosaSiswa', 'dataForChart'));
    }
}
