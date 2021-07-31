<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFeature extends Mailable
{
    use Queueable, SerializesModels;

    public String $pathToFile;
    public String $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->pathToFile = resource_path('views/emails/new-feature/comments.png');
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('New feature: Comments are here.')
            ->markdown('emails.new-feature.email');
    }
}
