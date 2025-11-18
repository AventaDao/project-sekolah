<?php

namespace App\Models;

use App\Traits\FormatPengajuanSurat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory, FormatPengajuanSurat;

    protected $fillable = [
        'user_id',
        'nomor_pengajuan',
        'jenis_surat',
        'keperluan',
        'surat_pengantar_rw',
        'keterangan_tambahan',
        'status',
        'catatan_admin',
        'file_surat_jadi',
        'tanggal_selesai',
        // SURAT KUA
        'nama_calon_mempelai',
        'tanggal_pernikahan',
        'nama_pasangan',
        'tujuan_kua',
        // SKTM
        'nama_penerima_sktm',
        'alasan_tidak_mampu',
        'keperluan_sktm',
        // SURAT DOMISILI
        'alamat_domisili',
        'rt_domisili',
        'rw_domisili',
        'tanggal_mulai_tinggal',
        'status_rumah',
        // SURAT KETERANGAN TANAH
        'deskripsi_tanah',
        'lokasi_tanah',
        'luas_tanah',
        'status_tanah',
        'nomor_sertifikat',
        // SKCK
        'tujuan_skck',
        'institusi_tujuan',
        'tanggal_dibutuhkan',
        // SURAT PERMOHONAN BANTUAN
        'jenis_bantuan',
        'jumlah_bantuan',
        'latar_belakang_bantuan',
        'prioritas_bantuan',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
        'tanggal_pernikahan' => 'date',
        'tanggal_mulai_tinggal' => 'date',
        'tanggal_dibutuhkan' => 'date',
        'luas_tanah' => 'decimal:2',
        'jumlah_bantuan' => 'decimal:2',
    ];

    /**
     * Get jenis surat dengan daftar tipe dan field yang diperlukan
     */
    public static function getSuratTypes()
    {
        return [
            'Surat KUA' => [
                'label' => 'Surat KUA (Kantor Urusan Agama)',
                'deskripsi' => 'Surat pengantar untuk keperluan administrasi di Kantor Urusan Agama',
                'fields' => [
                    'tujuan_kua' => ['label' => 'Tujuan KUA', 'type' => 'select', 'options' => ['Nikah', 'Rujuk', 'Pembatalan Pernikahan', 'Lainnya'], 'required' => true],
                    'nama_calon_mempelai' => ['label' => 'Nama Calon Mempelai', 'type' => 'text', 'required' => true],
                    'tanggal_pernikahan' => ['label' => 'Tanggal Pernikahan', 'type' => 'date', 'required' => true],
                    'nama_pasangan' => ['label' => 'Nama Pasangan', 'type' => 'text', 'required' => true],
                ]
            ],
            'Surat Keterangan Tidak Mampu' => [
                'label' => 'SKTM (Surat Keterangan Tidak Mampu)',
                'deskripsi' => 'Surat keterangan yang menyatakan kondisi ekonomi keluarga kurang mampu',
                'fields' => [
                    'nama_penerima_sktm' => ['label' => 'Nama Penerima SKTM', 'type' => 'text', 'required' => true],
                    'alasan_tidak_mampu' => ['label' => 'Alasan Tidak Mampu', 'type' => 'textarea', 'required' => true],
                    'keperluan_sktm' => ['label' => 'Keperluan SKTM', 'type' => 'select', 'options' => ['Beasiswa', 'Bantuan Sosial', 'Keringanan Biaya', 'Kesehatan', 'Lainnya'], 'required' => true],
                ]
            ],
            'Surat Domisili' => [
                'label' => 'Surat Domisili',
                'deskripsi' => 'Surat keterangan yang menyatakan tempat tinggal seseorang',
                'fields' => [
                    'alamat_domisili' => ['label' => 'Alamat Lengkap', 'type' => 'textarea', 'required' => true],
                    'rt_domisili' => ['label' => 'RT', 'type' => 'text', 'required' => true],
                    'rw_domisili' => ['label' => 'RW', 'type' => 'text', 'required' => true],
                    'tanggal_mulai_tinggal' => ['label' => 'Tanggal Mulai Tinggal', 'type' => 'date', 'required' => true],
                    'status_rumah' => ['label' => 'Status Rumah', 'type' => 'select', 'options' => ['Milik Sendiri', 'Sewa', 'Menumpang', 'Lainnya'], 'required' => true],
                ]
            ],
            'Surat Keterangan Tanah' => [
                'label' => 'Surat Keterangan Tanah',
                'deskripsi' => 'Surat keterangan kepemilikan atau penguasaan tanah',
                'fields' => [
                    'lokasi_tanah' => ['label' => 'Lokasi Tanah', 'type' => 'text', 'required' => true],
                    'luas_tanah' => ['label' => 'Luas Tanah (m²)', 'type' => 'number', 'step' => '0.01', 'required' => true],
                    'status_tanah' => ['label' => 'Status Tanah', 'type' => 'select', 'options' => ['Milik', 'Waris', 'Gadai', 'Sewa', 'Lainnya'], 'required' => true],
                    'nomor_sertifikat' => ['label' => 'Nomor Sertifikat (jika ada)', 'type' => 'text', 'required' => false],
                    'deskripsi_tanah' => ['label' => 'Deskripsi Tanah', 'type' => 'textarea', 'required' => true],
                ]
            ],
            'SKCK' => [
                'label' => 'SKCK (Surat Keterangan Catatan Kepolisian)',
                'deskripsi' => 'Surat pengantar dari desa untuk mengurus SKCK di kepolisian',
                'fields' => [
                    'tujuan_skck' => ['label' => 'Tujuan SKCK', 'type' => 'select', 'options' => ['Melamar Pekerjaan', 'Pendaftaran Sekolah', 'Izin Usaha', 'Beasiswa', 'Lainnya'], 'required' => true],
                    'institusi_tujuan' => ['label' => 'Institusi Tujuan', 'type' => 'text', 'required' => true],
                    'tanggal_dibutuhkan' => ['label' => 'Tanggal Dibutuhkan', 'type' => 'date', 'required' => true],
                ]
            ],
            'Surat Permohonan Bantuan' => [
                'label' => 'Surat Permohonan Bantuan',
                'deskripsi' => 'Surat permohonan bantuan untuk berbagai keperluan',
                'fields' => [
                    'jenis_bantuan' => ['label' => 'Jenis Bantuan', 'type' => 'select', 'options' => ['Bantuan Sosial', 'Renovasi Rumah', 'Kesehatan', 'Pendidikan', 'Bencana', 'Lainnya'], 'required' => true],
                    'jumlah_bantuan' => ['label' => 'Jumlah Bantuan (Rp)', 'type' => 'number', 'step' => '1', 'required' => false],
                    'latar_belakang_bantuan' => ['label' => 'Latar Belakang / Alasan Bantuan', 'type' => 'textarea', 'required' => true],
                    'prioritas_bantuan' => ['label' => 'Prioritas', 'type' => 'select', 'options' => ['Sangat Mendesak', 'Mendesak', 'Normal'], 'required' => true],
                ]
            ],
        ];
    }

    /**
     * Get field untuk jenis surat tertentu
     */
    public static function getFieldsForSuratType($jenisSurat)
    {
        $types = self::getSuratTypes();
        return $types[$jenisSurat]['fields'] ?? [];
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate nomor pengajuan otomatis
     */
    public static function generateNomorPengajuan()
    {
        $tahun = date('Y');
        $bulan = date('m');
        
        $lastPengajuan = self::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->orderBy('id', 'desc')
            ->first();
        
        $urutan = $lastPengajuan ? (int) substr($lastPengajuan->nomor_pengajuan, -4) + 1 : 1;
        
        return sprintf('SRT/%s/%s/%04d', $tahun, $bulan, $urutan);
    }

    /**
     * Get badge class berdasarkan status
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'Menunggu' => 'bg-warning',
            'Diproses' => 'bg-info',
            'Selesai' => 'bg-success',
            'Ditolak' => 'bg-danger',
            default => 'bg-secondary'
        };
    }
}