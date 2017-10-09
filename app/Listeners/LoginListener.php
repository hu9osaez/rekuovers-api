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
        $user = User::find($event->userId);
        $user->api_token = str_random(80);
        $user->last_signin = now();
        $user->last_signin_ip = request()->ip();
        $user->save();
    }
}
