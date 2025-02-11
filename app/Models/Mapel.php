<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapels';
    protected $fillable = [
        'mapel',
        'jurusan_id',
    ];

    public function guru()
    {
        return $this->belongsToMany(Guru::class, 'guru_mapel')
            ->withPivot('jurusan_id', 'kelas_id')
            ->withTimestamps();
    }
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'guru_mapel');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
