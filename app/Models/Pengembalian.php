<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = 'pengembalians';
    protected $fillable = [
        'id_anggota',
        'id_buku',
        'qty',
        'tanggal_pengembalian',
        'jumlah_hari_terlambat',
        'denda',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_buku');
    }
}
