<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeputusanController extends Controller
{
    public function index()
    {
        $keputusans = \DB::table('keputusans')
            ->orderBy('kode_gejala', 'asc')
            ->orderBy('kode_depresi', 'asc')
            ->paginate(10);
        $depresis = \DB::table('depresis')->get();
        $gejalas = \DB::table('gejalas')->get();
        return view('pages.keputusan.index', [
            'keputusans' => $keputusans,
            'depresis' => $depresis,
            'gejalas' => $gejalas
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $keputusans = \DB::table('keputusans')
            ->where('kode_gejala', 'like', "%{$search}%")
            ->orWhere('kode_depresi', 'like', "%{$search}%")
            ->orderBy('kode_gejala', 'asc')
            ->orderBy('kode_depresi', 'asc')
            ->paginate(10);

        return view('components.keputusan.table', [
            'keputusans' => $keputusans
        ]);
    }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $validated = $request->validate([
                'kode_gejala' => 'required',
                'kode_depresi' => 'required',
                'mb' => 'required',
                'md' => 'required',
            ], [
                'kode_gejala.required' => 'Kode gejala wajib diisi.',
                'kode_depresi.required' => 'Kode depresi wajib diisi.',
                'mb.required' => 'MB wajib diisi.',
                'md.required' => 'MD gejala wajib diisi.',
            ]);

            \DB::table('keputusans')->insert($validated);
            \DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan data keputusan!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
            $validated = $request->validate([
                'kode_gejala' => 'required',
                'kode_depresi' => 'required',
                'mb' => 'required',
                'md' => 'required',
            ], [
                'kode_gejala.required' => 'Kode gejala wajib diisi.',
                'kode_depresi.required' => 'Kode depresi wajib diisi.',
                'mb.required' => 'MB wajib diisi.',
                'md.required' => 'MD gejala wajib diisi.',
            ]);

            \DB::table('keputusans')->where('id', $id)->update($validated);
            \DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data keputusan!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            \DB::table('keputusans')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data keputusan!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
