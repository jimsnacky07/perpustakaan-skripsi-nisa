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
    protected $fillable = ['judul_buku', 'penerbit_buku', 'pengarang_buku', 'book_id', 'keterangan', 'jumlah_hilang'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'jumlah_hilang' => 'integer',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'penerbit_buku' => '',
        'pengarang_buku' => '',
        'keterangan' => '',
        'jumlah_hilang' => 1,
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id')->withDefault([
            'judul_buku' => '-',
            'penerbit_buku' => '-',
            'pengarang_buku' => '-',
            
        ]);
    }
}
