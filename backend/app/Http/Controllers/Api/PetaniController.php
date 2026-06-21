<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = Petani::with(['kecamatan', 'desa'])->get()->map(function ($p) {
            return [
                'id' => $p->id,
                'nama_petani' => $p->nama_petani,
                'nik' => $p->nik,
                'alamat' => $p->alamat,
                'kecamatan_id' => $p->kecamatan_id,
                'kecamatan' => $p->kecamatan ? $p->kecamatan->nama : null,
                'desa_id' => $p->desa_id,
                'desa' => $p->desa ? $p->desa->nama : null,
                'no_hp' => $p->no_hp,
            ];
        });

        return response()->json($petani);
    }

    public function show($id)
    {
        $p = Petani::with(['kecamatan', 'desa', 'lahan'])->find($id);

        if (!$p) {
            return response()->json(['message' => 'Petani tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $p->id,
            'nama_petani' => $p->nama_petani,
            'nik' => $p->nik,
            'alamat' => $p->alamat,
            'kecamatan_id' => $p->kecamatan_id,
            'kecamatan' => $p->kecamatan ? $p->kecamatan->nama : null,
            'desa_id' => $p->desa_id,
            'desa' => $p->desa ? $p->desa->nama : null,
            'no_hp' => $p->no_hp,
            'total_lahan' => $p->lahan->count(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_petani' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:petani,nik',
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'no_hp' => 'required|string|max:20',
        ]);

        $petani = Petani::create($validated);

        return response()->json($petani->load(['kecamatan', 'desa']), 201);
    }

    public function update(Request $request, $id)
    {
        $petani = Petani::findOrFail($id);

        $validated = $request->validate([
            'nama_petani' => 'required|string|max:255',
            'nik' => 'required|string|size:16|unique:petani,nik,' . $id,
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'desa_id' => 'required|exists:desa,id',
            'no_hp' => 'required|string|max:20',
        ]);

        $petani->update($validated);

        return response()->json($petani->load(['kecamatan', 'desa']));
    }

    public function destroy($id)
    {
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return response()->json(['message' => 'Petani berhasil dihapus']);
    }
}
