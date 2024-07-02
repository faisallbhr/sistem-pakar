<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $usersQuery = DB::table('users')
            ->select(
                'users.id',
                'users.name',
                'roles.name as kelas'
            )
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', '!=', 'guru')
            ->orderBy('roles.name', 'asc');

        if ($search) {
            $usersQuery->where('users.name', 'like', "%{$search}%");
        }

        $users = $usersQuery->paginate(10);

        if ($request->ajax()) {
            return view('components.diagnosa.users-table', [
                'users' => $users
            ]);
        }

        return view('pages.diagnosa.index', [
            'users' => $users
        ]);
    }
    public function history($userId)
    {
        if (!Auth::user()->hasRole('guru') && Auth::user()->id != $userId) {
            return redirect()->back();
        }

        $filter = request()->input('filter');
        $query = DB::table('diagnosas')
            ->select(
                'diagnosas.id',
                'diagnosas.persentase',
                'diagnosas.created_at',
                'diagnosas.kode_depresi',
                'users.name',
                'depresis.deskripsi',
                'roles.name as kelas'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('diagnosas.user_id', $userId);

        if ($filter) {
            $filterDate = Carbon::parse($filter);
            $query->whereDate('diagnosas.created_at', $filterDate->toDateString());
        }

        $history = $query->orderBy('diagnosas.created_at', 'desc')
            ->paginate(10);

        $dataForChart = [];
        foreach ($history as $item) {
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

        if ($filter) {
            if (request()->ajax()) {
                return response()->json([
                    'html' => view('components.diagnosa.table', ['history' => $history])->render(),
                    'chartData' => $dataForChart
                ]);
            }
            return view('components.diagnosa.table', ['history' => $history]);
        } else {
            return view('pages.diagnosa.history-user', [
                'history' => $history,
                'dataForChart' => $dataForChart,
            ]);
        }
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
                $maxValue = 1;
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
                'users.id as user_id',
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
            'artikel' => $artikel,
            'deadline' => Carbon::parse($diagnosa->created_at)->addDays(5)->format('d-m-Y')
        ]);
    }
    public function download($id)
    {
        $diagnosa = DB::table('diagnosas')->select(
            'diagnosas.id',
            'diagnosas.evidence',
            'diagnosas.persentase',
            'diagnosas.created_at',
            'users.name',
            'roles.name as kelas',
            'depresis.deskripsi as tingkat_depresi'
        )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('depresis', 'diagnosas.kode_depresi', '=', 'depresis.kode')
            ->where('diagnosas.id', $id)
            ->first();

        $diagnosa->kelas = $this->getKelas($diagnosa->kelas);
        $diagnosa->created_at = Carbon::parse($diagnosa->created_at)->format('d-m-Y');
        $diagnosa->deadline = Carbon::parse($diagnosa->created_at)->addDays(5)->format('d-m-Y');
        $diagnosa->evidence = $this->getEvidenceInfo($diagnosa->evidence);

        $data = (array) $diagnosa;
        $pdf = Pdf::loadView('pages.diagnosa.download', $data);
        return $pdf->download($diagnosa->name . ' ' . $diagnosa->created_at . '.pdf');
    }
    private function getKelas($role)
    {
        switch ($role) {
            case 'kelas 7':
                return 7;
            case 'kelas 8':
                return 8;
            case 'kelas 9':
                return 9;
            default:
                return 'guru';
        }
    }
    private function getEvidenceInfo($evidence)
    {
        $data = json_decode($evidence, true);
        $keys = array_keys($data);

        $gejalaDescriptions = DB::table('gejalas')
            ->whereIn('kode', $keys)
            ->pluck('deskripsi', 'kode');

        $kondisiDescriptions = [];

        foreach ($data as $key => $value) {
            $deskripsiKondisi = DB::table('kondisis')
                ->where('nilai', $value)
                ->value('deskripsi');

            $kondisiDescriptions[$key] = $deskripsiKondisi;
        }

        $newJson = [];
        foreach ($data as $key => $value) {
            $newJson[$key] = [
                'gejala' => $gejalaDescriptions[$key],
                'kondisi' => $kondisiDescriptions[$key]
            ];
        }

        return $newJson;
    }
}
