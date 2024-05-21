<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeputusanController extends Controller
{
    public function index()
    {
        $keputusans = DB::table('keputusans')
            ->orderBy('kode_rule', 'asc')
            ->orderBy('kode_gejala', 'asc')
            ->get();

        $formattedKeputusan = [];

        foreach ($keputusans as $keputusan) {
            $id = $keputusan->id;
            $kodeRule = $keputusan->kode_rule;
            $kodeDepresi = $keputusan->kode_depresi;
            $cf = $keputusan->cf;
            $kodeGejala = $keputusan->kode_gejala;

            if (!isset($formattedKeputusan[$kodeRule])) {
                $formattedKeputusan[$kodeRule] = [
                    'id' => $id,
                    'kode_rule' => $kodeRule,
                    'kode_gejala' => [],
                    'kode_depresi' => $kodeDepresi,
                    'cf' => $cf,
                ];
            }

            $formattedKeputusan[$kodeRule]['kode_gejala'][] = $kodeGejala;
        }

        $depresis = DB::table('depresis')->get();
        $gejalas = DB::table('gejalas')->get();
        return view('pages.keputusan.index', [
            'keputusans' => $formattedKeputusan,
            'depresis' => $depresis,
            'gejalas' => $gejalas
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $keputusans = DB::table('keputusans')
            ->where('kode_depresi', 'like', "%{$search}%")
            ->orderBy('kode_rule', 'asc')
            ->orderBy('kode_gejala', 'asc')
            ->get();

        $formattedKeputusan = [];

        foreach ($keputusans as $keputusan) {
            $id = $keputusan->id;
            $kodeRule = $keputusan->kode_rule;
            $kodeDepresi = $keputusan->kode_depresi;
            $cf = $keputusan->cf;
            $kodeGejala = $keputusan->kode_gejala;

            if (!isset($formattedKeputusan[$kodeRule])) {
                $formattedKeputusan[$kodeRule] = [
                    'id' => $id,
                    'kode_rule' => $kodeRule,
                    'kode_gejala' => [],
                    'kode_depresi' => $kodeDepresi,
                    'cf' => $cf,
                ];
            }

            $formattedKeputusan[$kodeRule]['kode_gejala'][] = $kodeGejala;
        }
        return view('components.keputusan.table', [
            'keputusans' => $formattedKeputusan
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'kode_rule' => 'required|unique:keputusans,kode_rule',
                'kode_gejala' => 'required|array',
                'kode_gejala.*' => 'required|exists:gejalas,kode',
                'kode_depresi' => 'required|exists:depresis,kode',
                'cf' => 'required|numeric',
            ], [
                'kode_rule.required' => 'Kode rule wajib diisi.',
                'kode_rule.unique' => 'Kode rule sudah digunakan.',
                'kode_gejala.required' => 'Kode gejala wajib diisi.',
                'kode_depresi.required' => 'Kode depresi wajib diisi.',
                'cf.required' => 'CF wajib diisi.',
                'cf.numeric' => 'CF harus berupa numeric.',
            ]);

            foreach ($request->input('kode_gejala') as $kodeGejala) {
                DB::table('keputusans')->insert([
                    'kode_rule' => $request->input('kode_rule'),
                    'kode_gejala' => $kodeGejala,
                    'kode_depresi' => $request->input('kode_depresi'),
                    'cf' => $request->input('cf')
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan data keputusan!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $kode_rule)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'kode_rule' => 'required|unique:keputusans,kode_rule,' . $kode_rule . ',kode_rule',
                'kode_gejala' => 'required|array',
                'kode_gejala.*' => 'required|exists:gejalas,kode',
                'kode_depresi' => 'required|exists:depresis,kode',
                'cf' => 'required|numeric',
            ], [
                'kode_rule.required' => 'Kode rule wajib diisi.',
                'kode_rule.unique' => 'Kode rule sudah digunakan.',
                'kode_gejala.required' => 'Kode gejala wajib diisi.',
                'kode_depresi.required' => 'Kode depresi wajib diisi.',
                'cf.required' => 'CF wajib diisi.',
                'cf.numeric' => 'CF harus berupa numeric.',
            ]);

            DB::table('keputusans')
                ->where('kode_rule', $kode_rule)
                ->delete();

            foreach ($request->input('kode_gejala') as $kodeGejala) {
                DB::table('keputusans')->insert([
                    'kode_rule' => $request->input('kode_rule'),
                    'kode_gejala' => $kodeGejala,
                    'kode_depresi' => $request->input('kode_depresi'),
                    'cf' => $request->input('cf')
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data keputusan!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($kode_rule)
    {
        try {
            DB::table('keputusans')->where('kode_rule', $kode_rule)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data keputusan!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
