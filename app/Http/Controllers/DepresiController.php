<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepresiController extends Controller
{
    public function index()
    {
        $depresis = DB::table('depresis')->paginate(10);
        return view('pages.depresi.index', [
            'depresis' => $depresis
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $depresis = DB::table('depresis')
            ->where('kode', 'like', "%{$search}%")
            ->paginate(10);

        return view('components.depresi.table', [
            'depresis' => $depresis
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'kode' => 'required|unique:depresis,kode',
                'deskripsi' => 'required'
            ], [
                'kode.required' => 'Kode depresi wajib diisi.',
                'kode.unique' => 'Kode depresi sudah digunakan.',
                'deskripsi.required' => 'Deskripsi depresi wajib diisi.'
            ]);

            DB::table('depresis')->insert($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan data depresi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $kode)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'kode' => 'required|unique:depresis,kode,' . $kode . ',kode',
                'deskripsi' => 'required'
            ], [
                'kode.required' => 'Kode depresi wajib diisi.',
                'kode.unique' => 'Kode depresi sudah digunakan.',
                'deskripsi.required' => 'Deskripsi depresi wajib diisi.'
            ]);

            DB::table('depresis')->where('kode', $kode)->update($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data depresi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($kode)
    {
        try {
            DB::table('depresis')->where('kode', $kode)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data depresi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
