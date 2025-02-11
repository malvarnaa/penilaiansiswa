<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konke extends Model
{
    use HasFactory;
    protected $table = 'konke';
    protected $fillable = [
        'nama_konke',
    ];
    public function mapels()
    {
        return $this->hasMany(Mapel::class);
    }
}
