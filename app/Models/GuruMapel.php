<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    use HasFactory;

    protected $table = 'guru_mapel';

    protected $fillable = ['guru_id', 'jurusan_id', 'kelas_id', 'mapel_id'];

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    // Relasi ke Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi ke Mapel (jika diperlukan untuk informasi mata pelajaran)
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
}
