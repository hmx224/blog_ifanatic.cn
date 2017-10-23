<?php

namespace App\Notifications;

use App\Models\Letter;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewLetterNotification extends Notification
{
    use Queueable;

    protected $letter;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Letter $letter)
    {
        $this->letter = $letter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->letter->fromUser->name,
            'dialog_id' => $this->letter->dialog_id
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
