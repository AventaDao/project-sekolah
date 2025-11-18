<?php

namespace App\Traits;

use App\Models\PengajuanSurat;

/**
 * Trait untuk memudahkan formatting data pengajuan surat
 */
trait FormatPengajuanSurat
{
    /**
     * Format field value berdasarkan tipe field
     */
    public function formatFieldValue($fieldName, $value, $jenisSurat = null)
    {
        if (!$value) {
            return '-';
        }

        $jenisSurat = $jenisSurat ?? $this->jenis_surat;
        $suratTypes = PengajuanSurat::getSuratTypes();
        $fieldConfig = $suratTypes[$jenisSurat]['fields'][$fieldName] ?? null;

        if (!$fieldConfig) {
            return $value;
        }

        switch ($fieldConfig['type']) {
            case 'date':
                return \Carbon\Carbon::parse($value)->format('d F Y');

            case 'number':
                // Jika field adalah jumlah bantuan, format sebagai currency
                if (strpos($fieldName, 'jumlah') !== false) {
                    return 'Rp. ' . number_format($value, 0, ',', '.');
                }
                // Jika field adalah luas tanah, tambahkan satuan
                if (strpos($fieldName, 'luas') !== false) {
                    return number_format($value, 2, ',', '.') . ' m²';
                }
                return number_format($value, 0, ',', '.');

            case 'textarea':
                return nl2br(htmlspecialchars($value));

            case 'text':
            case 'select':
            default:
                return htmlspecialchars($value);
        }
    }

    /**
     * Get semua field yang terisi untuk jenis surat tertentu
     */
    public function getFilledFields()
    {
        $suratTypes = PengajuanSurat::getSuratTypes();
        $fields = $suratTypes[$this->jenis_surat]['fields'] ?? [];
        $filledFields = [];

        foreach ($fields as $fieldName => $fieldConfig) {
            if ($this->$fieldName) {
                $filledFields[$fieldName] = [
                    'label' => $fieldConfig['label'],
                    'value' => $this->$fieldName,
                    'formatted_value' => $this->formatFieldValue($fieldName, $this->$fieldName),
                    'type' => $fieldConfig['type'],
                ];
            }
        }

        return $filledFields;
    }

    /**
     * Get deskripsi lengkap dari pengajuan surat dalam bentuk array
     */
    public function getSummaryArray()
    {
        return [
            'nomor_pengajuan' => $this->nomor_pengajuan,
            'jenis_surat' => $this->jenis_surat,
            'status' => $this->status,
            'keperluan' => $this->keperluan,
            'keterangan_tambahan' => $this->keterangan_tambahan,
            'fields' => $this->getFilledFields(),
            'tanggal_pengajuan' => $this->created_at->format('d F Y H:i'),
            'tanggal_diupdate' => $this->updated_at->format('d F Y H:i'),
        ];
    }

    /**
     * Validasi apakah semua field required sudah diisi
     */
    public function isComplete()
    {
        $suratTypes = PengajuanSurat::getSuratTypes();
        $fields = $suratTypes[$this->jenis_surat]['fields'] ?? [];

        foreach ($fields as $fieldName => $fieldConfig) {
            if ($fieldConfig['required'] && !$this->$fieldName) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get field yang belum diisi
     */
    public function getMissingFields()
    {
        $suratTypes = PengajuanSurat::getSuratTypes();
        $fields = $suratTypes[$this->jenis_surat]['fields'] ?? [];
        $missing = [];

        foreach ($fields as $fieldName => $fieldConfig) {
            if ($fieldConfig['required'] && !$this->$fieldName) {
                $missing[] = $fieldConfig['label'];
            }
        }

        return $missing;
    }
}
