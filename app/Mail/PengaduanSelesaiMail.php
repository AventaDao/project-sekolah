<?php

namespace App\Mail;

use App\Models\Pengaduan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PengaduanSelesaiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengaduan;
    public $userEmail;
    public $userName;

    /**
     * Create a new message instance.
     */
    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan;
        $this->userEmail = $pengaduan->user->email;
        $this->userName = $pengaduan->user->nama_lengkap;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pengaduan Anda Telah Selesai Ditangani - ' . $this->pengaduan->nomor_pengaduan,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.pengaduan-selesai',
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
