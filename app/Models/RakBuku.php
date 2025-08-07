<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RakBuku extends Model
{
    use HasFactory;

    protected $table = 'rak_bukus';
    protected $fillable = ['no_rak', 'nama_rak', 'kapasitas_rak'];

    /**
     * Get the books for this rack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'rak_buku_id', 'id');
    }
}
