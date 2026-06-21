<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use App\Models\Lahan;
use App\Models\Petani;

class StatistikController extends Controller
{
    public function index()
    {
        $totalPetani = Petani::count();
        $totalLahan = Lahan::count();
        $totalKunjungan = KunjunganLahan::count();

        $lahanPerFase = Lahan::selectRaw('status_fase, count(*) as total')
            ->groupBy('status_fase')
            ->pluck('total', 'status_fase');

        $lahanPerKomoditas = Lahan::selectRaw('komoditas, count(*) as total')
            ->groupBy('komoditas')
            ->pluck('total', 'komoditas');

        $lahanPerluTindakan = KunjunganLahan::where('status_tindak_lanjut', 'perlu_tindakan')
            ->distinct('lahan_id')
            ->count('lahan_id');

        return response()->json([
            'total_petani' => $totalPetani,
            'total_lahan' => $totalLahan,
            'total_kunjungan' => $totalKunjungan,
            'lahan_perlu_tindakan' => $lahanPerluTindakan,
            'lahan_per_fase' => $lahanPerFase,
            'lahan_per_komoditas' => $lahanPerKomoditas,
        ]);
    }
}
