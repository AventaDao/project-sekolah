<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageName;
    public $messageEmail;
    public $messageSubject;
    public $messageBody;
    public $messageCreatedAt;
    public $reply;
    public $supportId;

    /**
     * Create a new message instance.
     */
    public function __construct($message, $reply, $supportId)
    {
        $this->messageName = $message->name;
        $this->messageEmail = $message->email;
        $this->messageSubject = $message->subject;
        $this->messageBody = $message->message;
        $this->messageCreatedAt = $message->created_at;
        $this->reply = $reply;
        $this->supportId = $supportId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->supportId . ' - Balasan: ' . $this->messageSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reply-message',
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
