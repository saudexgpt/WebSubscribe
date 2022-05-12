<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriberMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $title;
    public $description;
    /**
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $description)
    {
        //
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $title = $this->title;
        $description = $this->description;

        // $user = $notifiable;
        return $this->view('emails.subscription')
            ->with([
                'title' => $title,
                'description' => $description,
            ]);
    }
}
