<?php
namespace Larashop\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LarashopAdminResetPassword extends Notification
{

    public function __construct($token)
    {
        $this->token = $token;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', route('password.reset.token',['token' => $this->token]))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;

// class LarashopAdminResetPassword extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @param  mixed  $notifiable
//      * @return array
//      */
//     public function via($notifiable)
//     {
//         return ['mail'];
//     }

//     /**
//      * Get the mail representation of the notification.
//      *
//      * @param  mixed  $notifiable
//      * @return \Illuminate\Notifications\Messages\MailMessage
//      */
//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//                     ->line('The introduction to the notification.')
//                     ->action('Notification Action', url('/'))
//                     ->line('Thank you for using our application!');
//     }

//     /**
//      * Get the array representation of the notification.
//      *
//      * @param  mixed  $notifiable
//      * @return array
//      */
//     public function toArray($notifiable)
//     {
//         return [
//             //
//         ];
//     }
// }
