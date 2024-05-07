<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = \DB::table('gejalas')->paginate(10);
        return view('pages.gejala.index', [
            'gejalas' => $gejalas
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $gejalas = \DB::table('gejalas')
            ->where('kode', 'like', "%{$search}%")
            ->paginate(10);

        return view('components.gejala.table', [
            'gejalas' => $gejalas
        ]);
    }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $validated = $request->validate([
                'kode' => 'required|unique:gejalas,kode',
                'deskripsi' => 'required',
                'mb' => 'required|numeric',
                'md' => 'required|numeric'
            ], [
                'kode.required' => 'Kode gejala wajib diisi.',
                'kode.unique' => 'Kode gejala sudah digunakan.',
                'deskripsi.required' => 'Deskripsi gejala wajib diisi.',
                'mb.required' => 'Nilai MB wajib diisi',
                'mb.numeric' => 'Nilai MB harus berupa numeric',
                'md.required' => 'Nilai MD wajib diisi',
                'md.numeric' => 'Nilai MD harus berupa numeric',
            ]);

            \DB::table('gejalas')->insert($validated);
            \DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan data gejala!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $kode)
    {
        try {
            \DB::beginTransaction();
            $validated = $request->validate([
                'kode' => 'required|unique:gejalas,kode,' . $kode . ',kode',
                'deskripsi' => 'required',
                'mb' => 'required|numeric',
                'md' => 'required|numeric'
            ], [
                'kode.required' => 'Kode gejala wajib diisi.',
                'kode.unique' => 'Kode gejala sudah digunakan.',
                'deskripsi.required' => 'Deskripsi gejala wajib diisi.',
                'mb.required' => 'Nilai MB wajib diisi',
                'mb.numeric' => 'Nilai MB harus berupa numeric',
                'md.required' => 'Nilai MD wajib diisi',
                'md.numeric' => 'Nilai MD harus berupa numeric',
            ]);

            \DB::table('gejalas')->where('kode', $kode)->update($validated);
            \DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data gejala!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($kode)
    {
        try {
            \DB::table('gejalas')->where('kode', $kode)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data gejala!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
