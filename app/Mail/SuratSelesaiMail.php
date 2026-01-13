<?php

namespace App\Mail;

use App\Models\PengajuanSurat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuratSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengajuanSurat;
    public $userEmail;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(PengajuanSurat $pengajuanSurat)
    {
        $this->pengajuanSurat = $pengajuanSurat;
        $this->userEmail = $pengajuanSurat->user->email;
        $this->userName = $pengajuanSurat->user->nama_lengkap;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Surat ' . $this->pengajuanSurat->jenis_surat . ' Anda Sudah Selesai - ' . $this->pengajuanSurat->nomor_pengajuan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.surat-selesai',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
