<?php

namespace App\Http\Controllers;

use DB;
use Exception;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    public function index()
    {
        $kondisis = DB::table('kondisis')
            ->orderBy('nilai', 'asc')
            ->paginate(10);
        return view('pages.kondisi.index', [
            'kondisis' => $kondisis
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $kondisis = DB::table('kondisis')
            ->where('deskripsi', 'like', "%{$search}%")
            ->paginate(10);

        return view('components.kondisi.table', [
            'kondisis' => $kondisis
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'deskripsi' => 'required',
                'nilai' => 'required',
            ]);

            DB::table('kondisis')->insert($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menambahkan data kondisi!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'deskripsi' => 'required',
                'nilai' => 'required',
            ], [
                'deskripsi.required' => 'Kondisi wajib diisi.',
                'nilai.required' => 'Nilai kondisi wajib diisi.',
            ]);

            DB::table('kondisis')->where('id', $id)->update($validated);
            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mengubah data kondisi!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            DB::table('kondisis')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus data kondisi!');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
