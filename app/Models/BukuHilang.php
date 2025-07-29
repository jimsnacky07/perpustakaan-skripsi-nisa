<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuHilang extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['judul_buku', 'penerbit_buku', 'pengarang_buku', 'tanggal_hilang', 'book_id', 'keterangan'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
