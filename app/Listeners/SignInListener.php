<?php namespace App\Listeners;

use App\Events\UserSignedIn;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

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
        $user = User::find($event->user_id);
        $user->last_signin = Carbon::now();
        $user->last_signin_ip = ip_client();
        $user->save();
    }
}