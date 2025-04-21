<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddBill extends Notification
{
    use Queueable;
    private $bill_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($bill_id)
    {
        $this->bill_id = $bill_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    { 
        $url = 'http://127.0.0.1:8000/billsDetails/'.$this->bill_id;
        return (new MailMessage)
                    ->subject('add new bill')
                    ->line('add new bill.')
                    ->action('View bill',$url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
