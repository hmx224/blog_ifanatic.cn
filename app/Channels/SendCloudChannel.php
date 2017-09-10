<?php


namespace App\Channels;

use Illuminate\Notifications\Notification;

class SendCloudChannel
{

    public function send($notifiable, Notification $notification)
    {
        return $notification->toSendcloud($notifiable);
    }
}