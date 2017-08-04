<?php namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Request;

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
        $user = User::find($event->user_id);
        $user->last_login = Carbon::now();
        $user->last_login_ip = Request::ip();
        $user->save();
    }
}