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
    protected $fillable = ['nisn', 'nama', 'jk', 'no_hp', 'alamat', 'user_id', 'kelas', 'foto'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
