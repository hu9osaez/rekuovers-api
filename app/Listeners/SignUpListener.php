<?php namespace App\Listeners;

use App\Events\UserSignedUp;
use App\Notifications\UserWelcome;

class SignUpListener
{
    /**
     * Handle the event.
     *
     * @param  UserSignedUp  $event
     * @return void
     */
    public function handle(UserSignedUp $event)
    {
        $user = $event->user;
        $user->confirmed = true;
        $user->save();

        //$user->notify(new UserWelcome());
    }
}
