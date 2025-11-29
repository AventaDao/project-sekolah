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
        'tanggal_diproses',
        'tanggal_ditolak',
        // SURAT KUA
        'nama_calon_mempelai',
        'tanggal_pernikahan',
        'nama_pasangan',
        'tujuan_kua',
        'fc_kk_pria',
        'fc_ktp_pria',
        'fc_akta_pria',
        'fc_kk_wanita',
        'fc_ktp_wanita',
        'fc_akta_wanita',
        'surat_keterangan_n1_n4',
        'foto_pas_pria',
        'foto_pas_wanita',
        // SKTM
        'nama_penerima_sktm',
        'alasan_tidak_mampu',
        'keperluan_sktm',
        'fc_ktp_sktm',
        'fc_kk_sktm',
        'foto_rumah_sktm',
        'slip_gaji_sktm',
        'bukti_kip_sktm',
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
        'fc_ktp_tanah',
        'fc_kk_tanah',
        'fc_npwp_tanah',
        'fc_ajb_atau_bukti_kepemilikan_tanah',
        'fc_sppt_pbb_tanah',
        // SKCK
        'tujuan_skck',
        'institusi_tujuan',
        'tanggal_dibutuhkan',
        'fc_ktp_skck',
        'fc_kk_skck',
        'fc_akta_ijazah_nikah_skck',
        'foto_pas_skck',
        // SURAT PERMOHONAN BANTUAN
        'jenis_bantuan',
        'jumlah_bantuan',
        'latar_belakang_bantuan',
        'prioritas_bantuan',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
        'tanggal_diproses' => 'datetime',
        'tanggal_ditolak' => 'datetime',
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
                    'nama_calon_mempelai' => ['label' => 'Nama Calon Mempelai (Pria)', 'type' => 'text', 'required' => true],
                    'tanggal_pernikahan' => ['label' => 'Tanggal Pernikahan', 'type' => 'date', 'required' => true],
                    'nama_pasangan' => ['label' => 'Nama Pasangan (Wanita)', 'type' => 'text', 'required' => true],
                    'fc_kk_pria' => ['label' => 'FC KK Mempelai Pria', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_ktp_pria' => ['label' => 'FC KTP Mempelai Pria', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_akta_pria' => ['label' => 'FC Akta Kelahiran Mempelai Pria', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_kk_wanita' => ['label' => 'FC KK Mempelai Wanita', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_ktp_wanita' => ['label' => 'FC KTP Mempelai Wanita', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_akta_wanita' => ['label' => 'FC Akta Kelahiran Mempelai Wanita', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'surat_keterangan_n1_n4' => ['label' => 'Surat Keterangan N1, N2, N3, N4 dari Kelurahan', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'foto_pas_pria' => ['label' => 'Foto Pas Mempelai Pria', 'type' => 'file', 'accept' => 'image/*', 'required' => true],
                    'foto_pas_wanita' => ['label' => 'Foto Pas Mempelai Wanita', 'type' => 'file', 'accept' => 'image/*', 'required' => true],
                ]
            ],
            'Surat Keterangan Tidak Mampu' => [
                'label' => 'SKTM (Surat Keterangan Tidak Mampu)',
                'deskripsi' => 'Surat keterangan yang menyatakan kondisi ekonomi keluarga kurang mampu dengan dokumen pendukung',
                'fields' => [
                    'nama_penerima_sktm' => ['label' => 'Nama Penerima SKTM', 'type' => 'text', 'required' => true],
                    'alasan_tidak_mampu' => ['label' => 'Alasan Tidak Mampu', 'type' => 'textarea', 'required' => true],
                    'keperluan_sktm' => ['label' => 'Keperluan SKTM', 'type' => 'select', 'options' => ['Beasiswa', 'Bantuan Sosial', 'Keringanan Biaya', 'Kesehatan', 'Lainnya'], 'required' => true],
                    'fc_ktp_sktm' => ['label' => 'FC KTP', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_kk_sktm' => ['label' => 'FC Kartu Keluarga (KK)', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'foto_rumah_sktm' => ['label' => 'Foto Rumah / Kondisi Tempat Tinggal', 'type' => 'file', 'accept' => 'image/*', 'required' => true],
                    'slip_gaji_sktm' => ['label' => 'Slip Gaji (jika bekerja)', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => false],
                    'bukti_kip_sktm' => ['label' => 'Bukti Pendaftaran KIP (jika untuk beasiswa)', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => false],
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
                'deskripsi' => 'Surat keterangan kepemilikan atau penguasaan tanah dengan dokumen pendukung lengkap',
                'fields' => [
                    'lokasi_tanah' => ['label' => 'Lokasi Tanah', 'type' => 'text', 'required' => true],
                    'luas_tanah' => ['label' => 'Luas Tanah (m²)', 'type' => 'number', 'step' => '0.01', 'required' => true],
                    'status_tanah' => ['label' => 'Status Tanah', 'type' => 'select', 'options' => ['Milik', 'Waris', 'Gadai', 'Sewa', 'Lainnya'], 'required' => true],
                    'nomor_sertifikat' => ['label' => 'Nomor Sertifikat (jika ada)', 'type' => 'text', 'required' => false],
                    'deskripsi_tanah' => ['label' => 'Deskripsi Tanah', 'type' => 'textarea', 'required' => true],
                    'fc_ktp_tanah' => ['label' => 'FC KTP', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_kk_tanah' => ['label' => 'FC Kartu Keluarga (KK)', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_npwp_tanah' => ['label' => 'FC NPWP', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_ajb_atau_bukti_kepemilikan_tanah' => ['label' => 'FC Akta Jual Beli (AJB) atau Bukti Kepemilikan Tanah Lainnya', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_sppt_pbb_tanah' => ['label' => 'FC SPPT PBB (Bukti Pembayaran Pajak) Tahun Berjalan', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                ]
            ],
            'SKCK' => [
                'label' => 'SKCK (Surat Keterangan Catatan Kepolisian)',
                'deskripsi' => 'Surat pengantar dari desa untuk mengurus SKCK di kepolisian dengan dokumen pendukung',
                'fields' => [
                    'tujuan_skck' => ['label' => 'Tujuan SKCK', 'type' => 'select', 'options' => ['Melamar Pekerjaan', 'Pendaftaran Sekolah', 'Izin Usaha', 'Beasiswa', 'Lainnya'], 'required' => true],
                    'institusi_tujuan' => ['label' => 'Institusi Tujuan', 'type' => 'text', 'required' => true],
                    'tanggal_dibutuhkan' => ['label' => 'Tanggal Dibutuhkan', 'type' => 'date', 'required' => true],
                    'fc_ktp_skck' => ['label' => 'FC KTP', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_kk_skck' => ['label' => 'FC Kartu Keluarga (KK)', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'fc_akta_ijazah_nikah_skck' => ['label' => 'FC Akta Kelahiran / Ijazah / Surat Nikah', 'type' => 'file', 'accept' => 'image/*,application/pdf', 'required' => true],
                    'foto_pas_skck' => ['label' => 'Pas Foto Berwarna 4x6 (6 lembar dengan latar merah)', 'type' => 'file', 'accept' => 'image/*', 'required' => true],
                ]
            ],
            'Surat Permohonan Bantuan' => [
                'label' => 'Surat Permohonan Bantuan',
                'deskripsi' => 'Surat permohonan bantuan untuk berbagai keperluan',
                'fields' => [
                    'jenis_bantuan' => ['label' => 'Jenis Bantuan', 'type' => 'select', 'options' => ['Bantuan Sosial', 'Renovasi Rumah', 'Kesehatan', 'Pendidikan', 'Bencana', 'Lainnya'], 'required' => true],
                    'jumlah_bantuan' => ['label' => 'Jumlah Bantuan (Rp)', 'type' => 'number', 'step' => '1', 'max' => '9999999999', 'required' => false],
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