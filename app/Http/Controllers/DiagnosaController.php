<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $query = DB::table('diagnosas')
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

        if (Auth::user()->hasRole('siswa')) {
            $query->where('user_id', Auth::user()->id);
        }

        $diagnosas = $query->paginate(10);

        return view('pages.diagnosa.index', [
            'diagnosas' => $diagnosas
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $diagnosas = DB::table('diagnosas')
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
        $filterDate = Carbon::parse($filter);
        $diagnosas = DB::table('diagnosas')
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
            ->where('user_id', Auth::user()->id)
            ->whereDate('diagnosas.created_at', $filterDate->toDateString())
            ->orderBy('diagnosas.created_at', 'desc')
            ->paginate(10);

        return view('components.diagnosa.table', [
            'diagnosas' => $diagnosas
        ]);
    }
    public function test()
    {
        $gejalas = DB::table('gejalas')->get();
        $kondisis = DB::table('kondisis')->get();
        return view('pages.diagnosa.test', [
            'gejalas' => $gejalas,
            'kondisis' => $kondisis
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $evidence = array_filter($request->input('cf_user'), function ($value) {
                return !is_null($value);
            });

            $gejalas = DB::table('gejalas')
                ->whereIn('kode', array_keys($evidence))
                ->get()
                ->keyBy('kode');

            $rules = DB::table('keputusans')->get();

            $cfResults = [];

            foreach ($rules as $rule) {
                $kodeGejala = $rule->kode_gejala;

                if (isset($gejalas[$kodeGejala])) {
                    $gejala = $gejalas[$kodeGejala];

                    $cf = $evidence[$gejala->kode] * ($gejala->mb - $gejala->md);
                    if (!isset($cfResults[$rule->kode_rule])) {
                        $cfResults[$rule->kode_rule] = [];
                    }

                    $cfResults[$rule->kode_rule][$rule->kode_gejala] = $cf;
                }
            }

            $minGejala = [];
            foreach ($cfResults as $rule => $gejalaCFs) {
                if (!isset($minGejala[$rule])) {
                    $minGejala[$rule] = INF;
                }

                foreach ($gejalaCFs as $cf) {
                    if ($cf < $minGejala[$rule]) {
                        $minGejala[$rule] = $cf;
                    }
                }
            }

            $cfRules = [];
            foreach ($minGejala as $rule => $cf) {
                $matchingRules = $rules->where('kode_rule', $rule);

                foreach ($matchingRules as $matchingRule) {
                    $cfRules[$rule] = $cf * $matchingRule->cf;
                }
            }

            $maxValue = -INF;
            $maxRule = null;

            foreach ($cfRules as $rule => $value) {
                if ($value > $maxValue) {
                    $maxValue = $value;
                    $maxRule = $rule;
                }
            }

            if ($maxValue == 0) {
                $depresiDiagnosa = DB::table('depresis')->where('kode', 'P000')->pluck('kode')->first();
            } else {
                $depresiDiagnosa = DB::table('keputusans')->where('kode_rule', $maxRule)->pluck('kode_depresi')->first();
            }

            $uuid = Str::uuid();
            DB::table('diagnosas')->insert([
                'id' => $uuid,
                'user_id' => Auth::user()->id,
                'evidence' => json_encode($evidence),
                'cf_user' => json_encode($cfResults),
                'min_gejala' => json_encode($minGejala),
                'cf_rule' => json_encode($cfRules),
                'kode_depresi' => $depresiDiagnosa,
                'persentase' => ($maxValue / 1) * 100,
                'created_at' => now()
            ]);

            DB::commit();
            return redirect()->route('diagnosa.result.user', ["diagnosaId" => $uuid]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function result($diagnosaId)
    {
        $diagnosa = DB::table('diagnosas')
            ->select(
                'diagnosas.*',
                'users.name',
                'depresis.deskripsi'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->where('diagnosas.id', $diagnosaId)
            ->first();

        $artikel = null;
        if ($diagnosa->kode_depresi != 'P000') {
            $artikel = DB::table('artikels')->where('kode_depresi', $diagnosa->kode_depresi)->first();
        }

        return view('pages.diagnosa.result', [
            'diagnosa' => $diagnosa,
            'artikel' => $artikel
        ]);
    }
}
