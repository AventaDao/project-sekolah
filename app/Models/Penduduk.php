<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'kewarganegaraan',
        'pendidikan_terakhir',
        'nama_ayah',
        'nama_ibu',
        'no_telepon',
        'status_hidup',
        'tanggal_meninggal',
        'source_type',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_meninggal' => 'date',
    ];

    /**
     * Get the age of the person
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return 0;
        }
        
        if ($this->status_hidup === 'Meninggal' && $this->tanggal_meninggal) {
            return (int) Carbon::parse($this->tanggal_lahir)->diffInYears(Carbon::parse($this->tanggal_meninggal));
        }
        return (int) Carbon::parse($this->tanggal_lahir)->diffInYears(now());
    }

    /**
     * Relasi ke User (jika penduduk memiliki akun)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    /**
     * Check if penduduk has user account
     */
    public function hasAccount()
    {
        return User::where('nik', $this->nik)->exists();
    }

    /**
     * Scope untuk penduduk yang memiliki akun
     */
    public function scopeHasUserAccount($query)
    {
        return $query->whereIn('nik', User::pluck('nik'));
    }

    /**
     * Scope untuk penduduk yang tidak memiliki akun
     */
    public function scopeNoUserAccount($query)
    {
        return $query->whereNotIn('nik', User::pluck('nik'));
    }
}