<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganLahan;
use App\Models\Lahan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani', 'petugas'])->orderBy('tanggal_kunjungan', 'desc')->paginate(10);
        return view('admin.kunjungan', compact('kunjungan'));
    }

    public function riwayatPetugas()
    {
        $kunjungan = KunjunganLahan::with(['lahan.petani'])
            ->where('petugas_id', auth()->id())
            ->orderBy('tanggal_kunjungan', 'desc')
            ->paginate(10);
        return view('petugas.kunjungan-index', compact('kunjungan'));
    }

    public function create()
    {
        $lahan = Lahan::with('petani')->get();
        return view('petugas.kunjungan-create', compact('lahan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lahan_id' => 'required|exists:lahan,id',
            'tanggal_kunjungan' => 'required|date',
            'kondisi_lahan' => 'required|in:baik,cukup,buruk',
            'catatan_lapangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
            'status_tindak_lanjut' => 'required|in:aman,perlu_pemantauan,perlu_tindakan',
            'status_fase' => 'required|in:persiapan,tanam,pemeliharaan,panen',
        ]);

        $validated['petugas_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kunjungan', 'public');
        }

        $statusFase = $validated['status_fase'];
        unset($validated['status_fase']);

        KunjunganLahan::create($validated);

        Lahan::where('id', $validated['lahan_id'])->update(['status_fase' => $statusFase]);

        $redirect = auth()->user()->role === 'petugas' ? route('petugas.kunjungan.create') : route('admin.kunjungan');

        return redirect($redirect)->with('success', 'Kunjungan berhasil dicatat.');
    }
}
