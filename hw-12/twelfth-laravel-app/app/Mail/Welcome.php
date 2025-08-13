<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public readonly User $user)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Добро пожаловать!',
        // Опционально: теги и метаданные для провайдеров
        // tags: ['welcome'],
        // metadata: ['user_id' => (string) $this->user->id],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome'
        // without with: $this->user доступен в Blade как {{ $user->... }}
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
