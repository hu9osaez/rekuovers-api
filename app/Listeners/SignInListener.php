<?php namespace App\Listeners;

use App\Events\UserSignedIn;
use App\Models\User;
use Carbon\Carbon;

class SignInListener
{
    /**
     * Handle the event.
     *
     * @param  UserSignedIn  $event
     * @return void
     */
    public function handle(UserSignedIn $event)
    {
        $user = User::find($event->userId);
        $user->last_signin = Carbon::now();
        $user->last_signin_ip = request()->ip();
        $user->save();
    }
}