<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendSubscriberEmail extends Notification  implements ShouldQueue
{
    use Queueable;
    public $title;
    public $description;
    /**
     * Create a new notification instance.
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
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $title = $this->title;
        $description = $this->description;
        $user = $notifiable;
        return (new MailMessage)->subject(env('APP_NAME') . ' - ' . $title)->view(
            'emails.subscription',
            compact('title', 'description', 'user')
        );
        // return (new MailMessage)
        //     ->greeting('Hello!')
        //     ->line($this->title)
        //     ->line($this->description)
        //     ->action('Check it out', $this->url)
        //     ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
