<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nama',
        'nisn',
        'tanggal_lahir',
        'wali_kelas_id',
        'status'
    ];

    public function waliKelas()
    {
        return $this->belongsTo(WaliKelas::class);
    }

    public function getKelasAttribute(): string
{
    return $this->waliKelas?->nama_kelas ?? '-';
}
}