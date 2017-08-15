<?php namespace App\Listeners;

use App\Events\UserSignedUp;
use App\Models\User;
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
        $user = User::find($event->user_id);
        $user->activation_code = str_random(40);
        $user->save();

        //$user->notify(new UserWelcome());
    }
}