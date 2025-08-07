<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    use HasFactory;

    protected $table = 'faktur';

    protected $fillable = [
        'nomor_faktur',
        'jenis_faktur',
        'id_transaksi',
        'id_anggota',
        'detail_items',
        'total_amount',
        'status',
        'tanggal_faktur',
        'tanggal_jatuh_tempo',
        'keterangan'
    ];

    protected $casts = [
        'detail_items' => 'array',
        'tanggal_faktur' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'total_amount' => 'decimal:2'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_transaksi');
    }

    public function pengembalian()
    {
        return $this->belongsTo(Pengembalian::class, 'id_transaksi');
    }

    // Method untuk generate nomor faktur
    public static function generateNomorFaktur($jenis)
    {
        $prefix = '';
        switch ($jenis) {
            case 'peminjaman':
                $prefix = 'INV-PJM';
                break;
            case 'pengembalian':
                $prefix = 'INV-KMB';
                break;
            case 'denda':
                $prefix = 'INV-DND';
                break;
        }

        $date = now()->format('Ymd');
        $lastFaktur = self::where('jenis_faktur', $jenis)
            ->whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastFaktur) {
            $lastNumber = (int) substr($lastFaktur->nomor_faktur, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . '-' . $date . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}
