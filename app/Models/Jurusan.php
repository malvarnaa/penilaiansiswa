<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $fillable = [
        'jurusan',
        'kode_jurusan',
    ];

    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

}
