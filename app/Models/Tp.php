<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tp extends Model
{
    use HasFactory;

    protected $table = 'tp';
    protected $fillable = [
        'no_tp',
        'nama_tp',
    ];
}
