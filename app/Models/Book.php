<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =
    [
        'jenis_buku_id',
        'judul_buku',
        'no_isbn',
        'tahun_terbit',
        'penerbit_buku',
        'pengarang_buku',
        'rak_buku_id',
        'jumlah_buku',
        'gambar',
    ];
}
