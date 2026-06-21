<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KunjunganLahan extends Model
{
    protected $table = 'kunjungan_lahan';

    protected $fillable = [
        'lahan_id', 'petugas_id', 'tanggal_kunjungan',
        'kondisi_lahan', 'catatan_lapangan', 'foto', 'status_tindak_lanjut'
    ];

    public function lahan(): BelongsTo
    {
        return $this->belongsTo(Lahan::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
