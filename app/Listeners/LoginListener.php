<?php namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\User;

class LoginListener
{
    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user = User::whereId($event->userId)->firstOrFail();
        $user->last_signin = now();
        $user->last_signin_ip = request()->ip();
        $user->save();
    }
}
