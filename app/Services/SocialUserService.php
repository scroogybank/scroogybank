<?php

namespace App\Services;

use App\Models\SocialUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialUserService
{
    /**
     * Search the database for a user with the given provider user id.
     * If the user is found, return the user, otherwise create a new user.
     * Users from different providers with the same email address are considered the same user.
     *
     * @param ProviderUser $providerUser
     * @param string $provider
     *
     * @return User|Model|mixed|null|object
     */
    public function createOrGetUser(ProviderUser $providerUser, string $provider)
    {
        $socialUser = SocialUser::with('user')
            ->where('provider', $provider)
            ->where('provider_user_id', $providerUser->getId())
            ->first();

        if ($socialUser) {
            return $socialUser->user;
        }

        $socialUser = new SocialUser([
            'provider_user_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        $user = User::where('email', $providerUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                // We create a random password for the user
                'password' => Hash::make(Str::random()),
                'avatar' => $providerUser->getAvatar(),
                'email_verified_at' => now(),
            ]);
        }

        $socialUser->user()->associate($user);
        $socialUser->save();

        return $user;
    }
}
