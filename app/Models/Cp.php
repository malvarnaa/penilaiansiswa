<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cp extends Model
{
    use HasFactory;

    protected $table = 'cp';
    protected $fillable = ['nama_cp', 'mapel_id', 'guru_id'];

    public function tp()
    {
        return $this->hasMany(Tp::class);
    }

    public function mapel() {
        return $this->belongsTo(Mapel::class);
    }
}
