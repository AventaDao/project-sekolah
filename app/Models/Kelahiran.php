<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelaharans';

    protected $fillable = [
        'penduduk_id',
        'nomor_akta',
        'tanggal_daftar',
        'penolong',
        'tempat',
        'berat',
        'panjang',
    ];

    protected $casts = [
        'tanggal_daftar' => 'date',
        'berat' => 'float',
        'panjang' => 'float',
    ];

    /**
     * Relasi ke Penduduk
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
