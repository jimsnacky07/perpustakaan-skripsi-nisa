<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanTemp extends Model
{
    use HasFactory;

    protected $table = 'peminjaman_temp';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['isbn', 'judul', 'jumlah'];
}
