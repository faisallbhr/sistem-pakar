<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $query = \DB::table('diagnosas')
            ->select(
                'diagnosas.id AS id',
                'diagnosas.data AS data',
                'diagnosas.hasil AS hasil',
                'diagnosas.created_at AS created_at',
                'users.name AS name'
            )
            ->orderBy('diagnosas.created_at', 'desc')
            ->join('users', 'diagnosas.user_id', '=', 'users.id');

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
                'diagnosas.id AS id',
                'diagnosas.data AS data',
                'diagnosas.hasil AS hasil',
                'diagnosas.created_at AS created_at',
                'users.name AS name'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
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
                'diagnosas.id AS id',
                'diagnosas.data AS data',
                'diagnosas.hasil AS hasil',
                'diagnosas.created_at AS created_at',
                'users.name AS name'
            )
            ->join('users', 'diagnosas.user_id', '=', 'users.id')
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
        $filteredArray = $request->post('kondisi');
        $kondisi = array_filter($filteredArray, function ($value) {
            return $value !== null;
        });

        $kodeGejala = [];
        $bobotPilihan = [];
        foreach ($kondisi as $key => $val) {
            if ($val != "#") {
                array_push($kodeGejala, $key);
                array_push($bobotPilihan, array($key, $val));
            }
        }

        $depresi = \DB::table('depresis')->get();
        $cf = 0;

        $arrGejala = [];
        foreach ($depresi as $depressi) {
            $cfArr = [
                "cf" => [],
                "kode_depresi" => []
            ];

            $ruleSetiapDepresi = \DB::table('keputusans')
                ->whereIn('kode_gejala', $kodeGejala)
                ->where('kode_depresi', $depressi->kode)
                ->get();

            if (count($ruleSetiapDepresi) > 0) {
                foreach ($ruleSetiapDepresi as $ruleKey) {
                    $cf = $ruleKey->mb - $ruleKey->md;
                    array_push($cfArr["cf"], $cf);
                    array_push($cfArr["kode_depresi"], $ruleKey->kode_depresi);
                }

                $res = $this->getGabunganCf($cfArr);
                array_push($arrGejala, $res);
            }
        }

        $uuid = Str::uuid();
        \DB::table('diagnosas')->insert([
            'id' => $uuid,
            'data' => json_encode($arrGejala),
            'hasil' => json_encode($bobotPilihan),
            'user_id' => \Auth::user()->id,
            'created_at' => now()
        ]);

        return redirect()->route('diagnosa.result.user', ["diagnosaId" => $uuid]);
    }

    public function getGabunganCf($cfArr)
    {
        if (empty($cfArr["cf"])) {
            return 0;
        }
        if (count($cfArr["cf"]) == 1) {
            return [
                "value" => strval($cfArr["cf"][0]),
                "kode_depresi" => $cfArr["kode_depresi"][0]
            ];
        }

        $cfoldGabungan = $cfArr["cf"][0];

        for ($i = 0; $i < count($cfArr["cf"]) - 1; $i++) {
            $cfoldGabungan = $cfoldGabungan + ($cfArr["cf"][$i + 1] * (1 - $cfoldGabungan));
        }

        return [
            "value" => "$cfoldGabungan",
            "kode_depresi" => $cfArr["kode_depresi"][0]
        ];
    }

    public function result($diagnosaId)
    {
        $diagnosa = \DB::table('diagnosas')->where('id', $diagnosaId)->first();
        $gejala = json_decode($diagnosa->hasil, true);
        $data_diagnosa = json_decode($diagnosa->data, true);

        $int = 0.0;
        $diagnosa_dipilih = [];
        foreach ($data_diagnosa as $val) {
            if (floatval($val["value"]) > $int) {
                $diagnosa_dipilih["value"] = floatval($val["value"]);
                $diagnosa_dipilih["kode_depresi"] = \DB::table('depresis')->where("kode", $val["kode_depresi"])->first();
                $int = floatval($val["value"]);
            }
        }

        $kodeGejala = array_column($gejala, 0);
        $kode_depresi = $diagnosa_dipilih["kode_depresi"]->kode;
        $pakar = \DB::table('keputusans')->whereIn("kode_gejala", $kodeGejala)->where("kode_depresi", $kode_depresi)->get();

        $gejala_by_user = [];
        foreach ($pakar as $key) {
            foreach ($gejala as $gKey) {
                if ($gKey[0] == $key->kode_gejala) {
                    $gejala_by_user[] = $gKey;
                }
            }
        }

        $nilaiPakar = [];
        foreach ($pakar as $key) {
            $nilaiPakar[] = ($key->mb - $key->md);
        }
        $nilaiUser = array_column($gejala_by_user, 1);

        $cfKombinasi = $this->getCfCombinasi($nilaiPakar, $nilaiUser);
        $hasil = $this->getGabunganCf($cfKombinasi);

        $artikel = \DB::table('artikels')->where('kode_depresi', $kode_depresi)->first();

        // dd([
        //     'diagnosa' => $diagnosa,
        //     'diagnosa_dipilih' => $diagnosa_dipilih,
        //     'gejala' => $gejala,
        //     'data_diagnosa' => $data_diagnosa,
        //     'pakar' => $pakar,
        //     'gejala_by_user' => $gejala_by_user,
        //     'cfKombinasi' => $cfKombinasi,
        //     'hasil' => $hasil
        // ]);

        return view('pages.diagnosa.result', compact('diagnosa', 'diagnosa_dipilih', 'data_diagnosa', 'pakar', 'gejala_by_user', 'cfKombinasi', 'hasil', 'artikel'));
    }

    public function getCfCombinasi($pakar, $user)
    {
        $cfComb = [];
        if (count($pakar) == count($user)) {
            for ($i = 0; $i < count($pakar); $i++) {
                $res = $pakar[$i] * $user[$i];
                $cfComb[] = floatval($res);
            }
            return [
                "cf" => $cfComb,
                "kode_depresi" => ["0"]
            ];
        } else {
            return "Data tidak valid";
        }
    }

}
