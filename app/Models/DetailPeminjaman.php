<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';
    protected $fillable = [
        'id_peminjaman',
        'isbn_buku',
        'judul_buku',
        'jumlah_buku',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn_buku', 'no_isbn');
    }
}
