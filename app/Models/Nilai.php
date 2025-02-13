<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['tp_id', 'siswa_id', 'nilai'];

    public function tp()
    {
        return $this->belongsTo(Tp::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}