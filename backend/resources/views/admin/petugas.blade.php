@extends('layouts.app')

@section('title', 'Manajemen Petugas - TaniPantau')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading mb-1">Daftar Petugas Lapang</h4>
            <p class="text-[0.9375rem] text-body m-0">Kelola akun petugas lapangan.</p>
        </div>
    </div>

    <div class="bg-white rounded-[0.5rem] shadow-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase w-12">#</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Nama</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Email</th>
                        <th class="px-6 py-3 border-b border-border bg-[#f9f9f9] text-[12px] font-semibold tracking-wide text-muted uppercase">Role</th>
                    </tr>
                </thead>
                <tbody class="text-[14px] text-body">
                    @forelse($petugas as $i => $p)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 border-b border-border text-muted">{{ $i + 1 }}</td>
                        <td class="px-6 py-4 border-b border-border font-medium text-heading">{{ $p->name }}</td>
                        <td class="px-6 py-4 border-b border-border">{{ $p->email }}</td>
                        <td class="px-6 py-4 border-b border-border">
                            <span class="px-3 py-1 rounded-[0.25rem] bg-info/10 text-info text-[12px] font-medium">{{ ucfirst($p->role) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-8 text-center text-muted">Belum ada petugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
