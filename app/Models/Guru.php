<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $fillable = [
        // 'no',
        'nomor',
        'nama',
        'jk',
        'user_id',
    ];

        public function user()
        {
            return $this->belongsTo(User::class, 'user_id');
        }
        public function mapel()
        {
            return $this->belongsToMany(Mapel::class, 'guru_mapel')
                ->withPivot('jurusan_id', 'kelas_id')
                ->withTimestamps();
        }
        public function jurusan()
        {
            return $this->belongsToMany(Jurusan::class, 'guru_mapel', 'guru_id', 'jurusan_id')
                ->withPivot('mapel_id', 'kelas_id')
                ->withTimestamps();
        }
    
        // Relasi Many-to-Many dengan Kelas melalui guru_mapel
        public function kelas()
        {
            return $this->belongsToMany(Kelas::class, 'guru_mapel', 'guru_id', 'kelas_id')
                ->withPivot('mapel_id', 'jurusan_id')
                ->withTimestamps();
        }

        public function guruMapel()
        {
            return $this->hasMany(GuruMapel::class, 'guru_id');
        }
}
