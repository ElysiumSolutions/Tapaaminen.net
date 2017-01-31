<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PostLiked extends Notification
{
    use Queueable;
    private $post, $liker;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post, $liker)
    {
        $this->post = $post;
        $this->liker = $liker;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'post_id' => $this->post->id,
            'liker_id' => $this->liker->id,
            'message' => $this->liker->name . ' tykkäsi viestistäsi!',
            'link' => url('/palsta/'.$this->post->thread->slug).'#'.$this->post->id
        ];
    }
}
