<?php

namespace App\Mail;

use App\Models\MailtoLink;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LinkCrawlerMail extends Mailable
{
    use Queueable, SerializesModels;

    public MailtoLink $recipient;
    public array $anchorsFound = [];
    public array $anchorsMissing = [];
    public array $anchorsUnableToLoad = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipient, $anchorsFound, $anchorsMissing, $anchorsUnableToLoad)
    {
        $this->recipient = $recipient;
        $this->anchorsFound = $anchorsFound;
        $this->anchorsMissing = $anchorsMissing;
        $this->anchorsUnableToLoad = $anchorsUnableToLoad;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            replyTo: [
                new Address(config('mail.from.address'), config('mail.from.name')),
            ],
            subject: 'SEO Center link crawling results',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.links.mail',
            with: [
                'to' => $this->recipient,
                'from' => $this->from
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
