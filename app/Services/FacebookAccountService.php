<?php namespace App\Services;

use App\Models\FacebookAccount;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class FacebookAccountService
{
    public function getOrCreateUser(ProviderUser $providerUser) {
        $facebookAccount = FacebookAccount::whereUserIdProvider($providerUser->getId())->first();

        if ($facebookAccount) {
            return $facebookAccount->user;
        }
        else {
            $facebookAccount = new FacebookAccount([
                'id_usuario_provider' => $providerUser->getId(),
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name'   => $providerUser->getName(),
                    'username' => str_slug($providerUser->getName()),
                    'email' => $providerUser->getEmail(),
                    'password' => md5(rand(1,10000))
                ]);

                // Registered user event
            }

            $facebookAccount->user()->associate($user);
            $facebookAccount->save();

            return $user;
        }
    }
}
