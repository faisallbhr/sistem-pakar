<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $gejala = \DB::table('gejalas')->count();
        $kondisi = \DB::table('kondisis')->count();
        $depresi = \DB::table('depresis')->count();
        $keputusan = \DB::table('keputusans')->count();
        $diagnosa = \DB::table('diagnosas')->count();
        $admin = \DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', 'roles.id')
            ->where('roles.name', 'guru')
            ->count();
        $diagnosaSiswa = \DB::table('diagnosas')
            ->where('user_id', \Auth::user()->id)
            ->count();

        return view('pages/dashboard/dashboard', compact('gejala', 'kondisi', 'depresi', 'keputusan', 'diagnosa', 'admin', 'diagnosaSiswa'));
    }
}
