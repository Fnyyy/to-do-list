<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SimpleNotification extends Notification
{
    use Queueable;

    public $title;
    public $message;
    public $type; // info, success, warning, error
    public $actionUrl;

    public function __construct($title, $message, $type = 'info', $actionUrl = '#')
    {
        $this->title = $title;
        $this->message = $message;
        $this->type = $type;
        $this->actionUrl = $actionUrl;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'title' => $this->title,
            'type' => $this->type,
            'url' => $this->actionUrl,
        ];
    }
}
