<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'kelas',
        'no_jrs',
        'jurusan_id',
        'kode_jurusan'
    ];

    public function mapel(){
        return $this->belongsToMany(Mapel::class, 'guru_mapel');
    }

    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel', 'kelas_id', 'guru_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
