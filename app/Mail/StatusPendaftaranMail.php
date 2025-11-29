<?php

namespace App\Mail;

use App\Models\PendaftaranMagang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusPendaftaranMail extends Mailable
{
    use Queueable, SerializesModels;
    public PendaftaranMagang $pendaftaran;

    /**
     * Create a new message instance.
     */
    public function __construct(PendaftaranMagang $pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $subject = match ($this->pendaftaran->status) {
            'diterima' => 'Pendaftaran Magang Anda DITERIMA',
            'ditolak'  => 'Pendaftaran Magang Anda BELUM DAPAT DITERIMA',
            default    => 'Status Pendaftaran Magang Anda',
        };

        return $this->subject($subject)
            ->markdown('emails.status-pendaftaran');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Status Pendaftaran Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.status-pendaftaran',
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
