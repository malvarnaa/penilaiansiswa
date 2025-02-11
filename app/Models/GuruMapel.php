<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruMapel extends Model
{
    use HasFactory;

    protected $table = 'guru_mapel';
    protected $fillable = [
        'guru_id',
        'jurusan_id',
        'kelas_id',
        'mapel_id',
    ];
}
