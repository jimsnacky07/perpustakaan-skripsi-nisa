<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nisn', 'nama', 'jk', 'no_hp', 'alamat', 'user_id', 'kelas', 'foto', 'status', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class, 'id_anggota');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota_peminjaman');
    }
}
