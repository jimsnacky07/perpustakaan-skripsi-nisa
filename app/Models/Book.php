<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategoriBuku(): BelongsTo
    {
        return $this->belongsTo(JenisBuku::class, 'jenis_buku_id', 'id');
    }
}
