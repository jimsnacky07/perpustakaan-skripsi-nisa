<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RakBuku extends Model
{
    use HasFactory;

    protected $table = 'rak_bukus';
    protected $fillable = ['no_rak', 'nama_rak', 'kapasitas_rak'];
}
