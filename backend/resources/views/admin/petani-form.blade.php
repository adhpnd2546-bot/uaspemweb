@extends('layouts.app')

@section('title', $title . ' - TaniPantau')

@section('content')
<div class="max-w-3xl mx-auto w-full">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.petani.index') }}" class="p-2 rounded-full hover:bg-slate-100 transition-colors text-heading">
            <span class="material-symbols-outlined text-[24px]">arrow_back</span>
        </a>
        <div>
            <h4 class="text-[1.25rem] font-medium text-heading mb-1">{{ $title }}</h4>
            <p class="text-[0.9375rem] text-body m-0">Lengkapi formulir di bawah dengan data yang benar.</p>
        </div>
    </div>

    <form action="{{ $petani ? route('admin.petani.update', $petani->id) : route('admin.petani.store') }}" method="POST" class="bg-white rounded-[0.5rem] shadow-card p-6 sm:p-8">
        @csrf
        @if($petani) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="nama_petani">Nama Petani <span class="text-danger">*</span></label>
                <input type="text" id="nama_petani" name="nama_petani" value="{{ old('nama_petani', $petani->nama_petani ?? '') }}" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('nama_petani') border-danger @enderror" required>
                @error('nama_petani') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="nik">NIK <span class="text-danger">*</span></label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', $petani->nik ?? '') }}" maxlength="16" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('nik') border-danger @enderror" required>
                @error('nik') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col md:col-span-2">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="alamat">Alamat <span class="text-danger">*</span></label>
                <textarea id="alamat" name="alamat" rows="2" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('alamat') border-danger @enderror" required>{{ old('alamat', $petani->alamat ?? '') }}</textarea>
                @error('alamat') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="kecamatan_id">Kecamatan <span class="text-danger">*</span></label>
                <select id="kecamatan_id" name="kecamatan_id" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('kecamatan_id') border-danger @enderror" required>
                    <option value="">Pilih Kecamatan...</option>
                    @foreach($kecamatan as $k)
                        <option value="{{ $k->id }}" {{ old('kecamatan_id', $petani->kecamatan_id ?? '') == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
                @error('kecamatan_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="desa_id">Desa <span class="text-danger">*</span></label>
                <select id="desa_id" name="desa_id" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('desa_id') border-danger @enderror" required>
                    <option value="">Pilih Desa...</option>
                    @foreach($kecamatan as $k)
                        @foreach($k->desa as $d)
                            <option value="{{ $d->id }}" data-kecamatan="{{ $k->id }}" {{ old('desa_id', $petani->desa_id ?? '') == $d->id ? 'selected' : '' }}>{{ $d->nama }}</option>
                        @endforeach
                    @endforeach
                </select>
                @error('desa_id') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5" for="no_hp">Nomor HP <span class="text-danger">*</span></label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $petani->no_hp ?? '') }}" class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] text-heading focus:ring-1 focus:ring-primary focus:border-primary outline-none transition-all bg-white @error('no_hp') border-danger @enderror" required>
                @error('no_hp') <small class="text-danger mt-1">{{ $message }}</small> @enderror
            </div>

            <div class="flex flex-col">
                <label class="text-[13px] font-medium text-heading mb-1.5">Status Petani</label>
                <div class="w-full border border-border rounded-[0.375rem] px-3 py-2 text-[15px] bg-[#f8f9fa] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-success inline-block"></span>
                    <span class="text-heading font-medium">Aktif</span>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-border">
            <a href="{{ route('admin.petani.index') }}" class="px-5 py-2 bg-white border border-border rounded-[0.375rem] text-[14px] text-heading font-medium hover:bg-slate-100 transition-colors">Batal</a>
            <button type="submit" class="px-5 py-2 bg-primary text-white rounded-[0.375rem] text-[14px] font-medium hover:bg-primary-hover transition-colors shadow-primary">
                {{ $petani ? 'Perbarui' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kecSelect = document.getElementById('kecamatan_id');
        const desaSelect = document.getElementById('desa_id');

        const allDesa = Array.from(desaSelect.options).slice(1).map(opt => ({
            id: opt.value,
            nama: opt.text,
            kecamatan_id: opt.dataset.kecamatan
        }));

        function filterDesa() {
            const selectedKec = kecSelect.value;
            desaSelect.innerHTML = '<option value="">Pilih Desa...</option>';
            allDesa.filter(d => d.kecamatan_id === selectedKec).forEach(d => {
                const opt = document.createElement('option');
                opt.value = d.id;
                opt.textContent = d.nama;
                desaSelect.appendChild(opt);
            });
        }

        kecSelect.addEventListener('change', filterDesa);

        // Trigger on load if editing
        if (kecSelect.value) {
            filterDesa();
            // Re-select the original desa if editing
            const originalDesa = '{{ old('desa_id', $petani->desa_id ?? '') }}';
            if (originalDesa) {
                desaSelect.value = originalDesa;
            }
        }
    });
</script>
@endpush

@endsection
