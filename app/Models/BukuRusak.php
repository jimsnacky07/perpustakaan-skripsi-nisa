<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuRusak extends Model
{
    use HasFactory;
    protected $table = 'buku_rusaks';

    protected $fillable = [
        'judulbuku',
        'jumlahrusak',
        'penyebab',
        'keterangan',
        'book_id',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}