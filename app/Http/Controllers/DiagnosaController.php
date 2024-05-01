<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $query = \DB::table('diagnosas')
            ->select(
                'diagnosas.id',
                'diagnosas.persentase',
                'diagnosas.created_at',
                'diagnosas.kode_depresi',
                'users.name',
                'depresis.deskripsi'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->orderBy('diagnosas.created_at', 'desc');

        if (\Auth::user()->hasRole('siswa')) {
            $query->where('user_id', \Auth::user()->id);
        }

        $diagnosas = $query->paginate(10);

        return view('pages.diagnosa.index', [
            'diagnosas' => $diagnosas
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $diagnosas = \DB::table('diagnosas')
            ->select(
                'diagnosas.id',
                'diagnosas.persentase',
                'diagnosas.created_at',
                'diagnosas.kode_depresi',
                'users.name',
                'depresis.deskripsi'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->where('users.name', 'like', "%{$search}%")
            ->orderBy('diagnosas.created_at', 'desc')
            ->paginate(10);

        return view('components.diagnosa.table', [
            'diagnosas' => $diagnosas
        ]);
    }
    public function filter(Request $request)
    {
        $filter = $request->input('filter');
        $filterDate = \Carbon\Carbon::parse($filter);
        $diagnosas = \DB::table('diagnosas')
            ->select(
                'diagnosas.id',
                'diagnosas.persentase',
                'diagnosas.created_at',
                'diagnosas.kode_depresi',
                'users.name',
                'depresis.deskripsi'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->where('user_id', \Auth::user()->id)
            ->whereDate('diagnosas.created_at', $filterDate->toDateString())
            ->orderBy('diagnosas.created_at', 'desc')
            ->paginate(10);

        return view('components.diagnosa.table', [
            'diagnosas' => $diagnosas
        ]);
    }
    public function test()
    {
        $gejalas = \DB::table('gejalas')->get();
        $kondisis = \DB::table('kondisis')->get();
        return view('pages.diagnosa.test', [
            'gejalas' => $gejalas,
            'kondisis' => $kondisis
        ]);
    }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();

            // Ambil input pengguna berupa gejala yang dipilih beserta nilai CF
            $cfUserInput = array_filter($request->input('cf_user'), function ($value) {
                return !is_null($value);
            });

            // Mengambil semua rule dari tabel keputusans
            $rules = \DB::table('keputusans')->get();

            // Array untuk menyimpan CF Gabungan untuk setiap kode depresi
            $cfGabungan = [];

            // Iterasi melalui rules
            foreach ($rules as $rule) {
                $kodeDepresi = $rule->kode_depresi;
                $kodeGejala = $rule->kode_gejala;

                // Periksa apakah kode gejala terdapat dalam inputan pengguna
                if (isset($cfUserInput[$kodeGejala])) {
                    $cfUser = floatval($cfUserInput[$kodeGejala]);
                    $cfPartial = ($rule->mb - $rule->md) * $cfUser;

                    // Perbarui atau tambahkan CF Gabungan
                    if (isset($cfGabungan[$kodeDepresi])) {
                        $cfGabungan[$kodeDepresi] = $cfGabungan[$kodeDepresi] + $cfPartial * (1 - $cfGabungan[$kodeDepresi]);
                    } else {
                        $cfGabungan[$kodeDepresi] = $cfPartial;
                    }
                }
            }

            // Temukan nilai CF Gabungan maksimum dan tentukan diagnosa depresi akhir
            $maxCF = max($cfGabungan);
            $depresi = array_search($maxCF, $cfGabungan);

            $cfPakarDiagnosa = \DB::table('keputusans')
                ->where('kode_depresi', $depresi)
                ->whereIn('kode_gejala', array_keys($cfUserInput))
                ->get();

            $cfUserInputFiltered = array_intersect_key($cfUserInput, $cfPakarDiagnosa->keyBy('kode_gejala')->toArray());

            $uuid = Str::uuid();
            \DB::table('diagnosas')->insert([
                'id' => $uuid,
                'user_id' => \Auth::user()->id,
                'cf_pakar' => json_encode($cfPakarDiagnosa),
                'cf_user' => json_encode($cfUserInputFiltered),
                'kode_depresi' => $depresi,
                'persentase' => $maxCF * 100,
                'created_at' => now()
            ]);

            \DB::commit();
            return redirect()->route('diagnosa.result.user', ["diagnosaId" => $uuid]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function result($diagnosaId)
    {
        $diagnosa = \DB::table('diagnosas')
            ->select(
                'diagnosas.*',
                'users.name',
                'depresis.deskripsi'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->where('diagnosas.id', $diagnosaId)
            ->first();

        $artikel = \DB::table('artikels')
            ->where('kode_depresi', $diagnosa->kode_depresi)
            ->first();

        $cfPakar = json_decode($diagnosa->cf_pakar, true);
        $cfUser = json_decode($diagnosa->cf_user, true);

        $cfHasil = [];
        foreach ($cfPakar as $pakar) {
            $kodeGejala = $pakar['kode_gejala'];
            $mb = $pakar['mb'];
            $md = $pakar['md'];

            if (isset($cfUser[$kodeGejala])) {
                $cfPakarValue = $mb - $md;
                $cfUserValue = floatval($cfUser[$kodeGejala]);
                $cfHasilValue = $cfPakarValue * $cfUserValue;

                $cfHasil[$kodeGejala] = $cfHasilValue;
            }
        }

        return view('pages.diagnosa.result', [
            'diagnosa' => $diagnosa,
            'cfPakar' => $cfPakar,
            'cfUser' => $cfUser,
            'cfHasil' => $cfHasil,
            'artikel' => $artikel,
        ]);
    }
}
