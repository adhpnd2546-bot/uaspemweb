<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;

class WilayahController extends Controller
{
    public function kecamatan()
    {
        return response()->json(Kecamatan::with('desa')->get());
    }

    public function desa($kecamatanId)
    {
        $desa = Desa::where('kecamatan_id', $kecamatanId)->get();
        return response()->json($desa);
    }
}
