<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'description',
        'related_id',
        'related_type',
        'ip_address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get activity types
     */
    public static function getActivityTypes()
    {
        return [
            'login' => 'Login',
            'logout' => 'Logout',
            'register' => 'Pendaftaran Akun',
            'profile_update' => 'Update Profil',
            'password_change' => 'Ubah Password',
            'email_verify' => 'Verifikasi Email',
            'pengajuan_surat_create' => 'Buat Pengajuan Surat',
            'pengajuan_surat_update' => 'Update Pengajuan Surat',
            'pengajuan_surat_delete' => 'Batalkan Pengajuan Surat',
            'pengajuan_surat_download' => 'Download Surat',
            'pengaduan_create' => 'Buat Pengaduan',
            'pengaduan_delete' => 'Batalkan Pengaduan',
            'berita_view' => 'Baca Berita',
        ];
    }

    /**
     * Log activity
     */
    public static function log($activityType, $description = null, $relatedId = null, $relatedType = null)
    {
        if (!auth()->check()) {
            return;
        }

        $types = self::getActivityTypes();
        
        return self::create([
            'user_id' => auth()->id(),
            'activity_type' => $activityType,
            'description' => $description ?? $types[$activityType] ?? $activityType,
            'related_id' => $relatedId,
            'related_type' => $relatedType,
            'ip_address' => request()->ip(),
        ]);
    }
}
