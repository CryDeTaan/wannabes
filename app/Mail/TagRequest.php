<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TagRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected User $user;
    protected String $tag;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $tag)
    {
        $this->user = $user;
        $this->tag = $tag;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.tag.request', [
            'user' => $this->user,
            'tag' => $this->tag,
        ]);
    }
}
