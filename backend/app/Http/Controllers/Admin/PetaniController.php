<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = Petani::withCount('lahan')->with(['kecamatan', 'desa'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.petani', compact('petani'));
    }

    public function create()
    {
        $kecamatan = Kecamatan::with('desa')->get();
        return view('admin.petani-form', ['petani' => null, 'title' => 'Tambah Petani', 'kecamatan' => $kecamatan]);
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

        Petani::create($validated);

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $petani = Petani::with(['kecamatan', 'desa'])->findOrFail($id);
        $kecamatan = Kecamatan::with('desa')->get();
        return view('admin.petani-form', ['petani' => $petani, 'title' => 'Edit Petani', 'kecamatan' => $kecamatan]);
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

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $petani = Petani::findOrFail($id);
        $petani->delete();

        return redirect()->route('admin.petani.index')->with('success', 'Data petani berhasil dihapus.');
    }
}
