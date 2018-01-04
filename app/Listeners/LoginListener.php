<?php namespace App\Listeners;

use App\Events\UserLoggedIn;

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
        $user = $event->user;
        $user->last_signin = now();
        $user->last_signin_ip = request()->ip();
        $user->save();
    }
}
