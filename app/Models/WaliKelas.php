<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    protected $table = 'wali_kelas';

    protected $fillable = [
        'nama_wali',
        'nama_kelas',
        'komentar'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}