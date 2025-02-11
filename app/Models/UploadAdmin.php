<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadAdmin extends Model
{
    protected $table = 'upload_admin';
    protected $fillable = ['file_name', 'file_path', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
