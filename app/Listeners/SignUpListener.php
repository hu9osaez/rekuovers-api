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
        $user = User::find($event->userId);

        $user->notify(new UserWelcome());
    }
}