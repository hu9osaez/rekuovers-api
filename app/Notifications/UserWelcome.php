<?php

namespace App\Notifications;

use App\Mail\WelcomeMail as Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserWelcome extends Notification implements ShouldQueue
{
    use Queueable;

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
     *
     *
     * @param  mixed  $notifiable
     * @return \App\Mail\WelcomeMail
     */
    public function toMail($notifiable)
    {
         return (new Mailable($notifiable))
             ->from('support@rekuovers.com', 'Rekuovers')
             ->subject('Welcome to Rekuovers');
    }
}
