@extends('layouts.app')

@section('title', 'Riwayat Kunjungan - TaniPantau')

@section('content')
    @if(session('success'))
    <div class="mb-4 px-4 py-3 bg-success/10 border border-success/20 text-success rounded-[0.5rem] text-[14px] font-medium">
        {{ session('success') }}
    </div>
    @endif

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading mb-1">Riwayat Kunjungan</h4>
            <p class="text-[0.9375rem] text-body m-0">Seluruh data kunjungan petugas lapangan.</p>
        </div>
    </div>

    <div class="bg-white rounded-[0.5rem] shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[900px]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase w-12">#</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Tanggal</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Lahan</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Petugas</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Kondisi</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Tindak Lanjut</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Catatan</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body">
                    @forelse($kunjungan as $i => $k)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 border-b border-border text-muted">{{ $kunjungan->firstItem() + $i }}</td>
                        <td class="px-6 py-4 border-b border-border font-medium text-heading">{{ \Carbon\Carbon::parse($k->tanggal_kunjungan)->format('d M Y') }}</td>
                        <td class="px-6 py-4 border-b border-border">{{ $k->lahan->nama_lahan ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border">{{ $k->petugas->name ?? '-' }}</td>
                        <td class="px-6 py-4 border-b border-border">
                            @php
                                $kondisiStyles = ['baik' => 'background:#71dd3720;color:#56b82a;', 'cukup' => 'background:#ffab0020;color:#e69a00;', 'buruk' => 'background:#ff3e1d20;color:#ff3e1d;'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] text-[12px] font-semibold inline-block" style="{{ $kondisiStyles[$k->kondisi_lahan] ?? 'background:#8592a315;color:#8592a3;' }}">{{ ucfirst($k->kondisi_lahan) }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border">
                            @php
                                $tindakStyles = ['aman' => 'background:#71dd3720;color:#56b82a;', 'perlu_pemantauan' => 'background:#ffab0020;color:#e69a00;', 'perlu_tindakan' => 'background:#ff3e1d20;color:#ff3e1d;'];
                                $tindakLabels = ['aman' => 'Aman', 'perlu_pemantauan' => 'Perlu Pantau', 'perlu_tindakan' => 'Perlu Tindakan'];
                            @endphp
                            <span class="px-2 py-1 rounded-[0.25rem] text-[12px] font-semibold inline-block" style="{{ $tindakStyles[$k->status_tindak_lanjut] ?? 'background:#8592a315;color:#8592a3;' }}">{{ $tindakLabels[$k->status_tindak_lanjut] ?? $k->status_tindak_lanjut }}</span>
                        </td>
                        <td class="px-6 py-4 border-b border-border max-w-[200px] truncate">{{ $k->catatan_lapangan ? Str::limit($k->catatan_lapangan, 50) : '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-6 py-8 text-center text-muted">Belum ada data kunjungan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kunjungan->hasPages())
        <div class="px-6 py-4 border-t border-border flex justify-center">
            {{ $kunjungan->links() }}
        </div>
        @endif
    </div>
@endsection
