<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tp extends Model
{
    use HasFactory;

    protected $table = 'tp';
    protected $fillable = ['cp_id', 'nama_tp'];

    public function cp()
    {
        return $this->belongsTo(Cp::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
