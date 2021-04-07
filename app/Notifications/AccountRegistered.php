<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountRegistered extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request, $password)
    {
        $this->request = $request;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \Coconuts\Mail\MailMessage)
            ->alias('welcome-1')
            ->include([
                "ime" => $this->request->ime,
                "password" => $this->password,
                "product_name" => config('APP_NAME'),
                "action_url" => "action_url_1111111111111111111",
                "login_url" => "login_url_1111111111111111111",
                "support_email" => "support_email_1111111111111111111",
                "live_chat_url" => "live_chat_url_1111111111111111111",
                "sender_name" => "sender_name_1111111111111111111",
                "help_url" => "help_url_1111111111111111111",
                "product_url" => "product_url_1111111111111111111",
                "company_name" => "company_name_1111111111111111111",
                "company_address" => "company_address_1111111111111111111",
            ]);
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
        ];
    }
}
