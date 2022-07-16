<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostEmailToAdmin extends Mailable
{
    use Queueable, SerializesModels;

    // Nel controller inviamo qui i dati del post. Li raccogliamo in new_post perché servirà ad entrambe le funzioni qui sotto.
    public $new_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_new_post)
    {
        $this->new_post = $_new_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $new_post = $this->new_post;
        return $this->view('mails.new-post-email-to-admin', compact('new_post'));
    }
}
