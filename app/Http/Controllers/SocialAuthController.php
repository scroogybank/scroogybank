<?php

namespace App\Http\Controllers;

use App\Models\SocialUserService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to the provider login page.
     *
     * @return mixed
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Retrieve user info from provider.
     *
     * @param SocialUserService $service
     * @param string $provider
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function handleProviderCallback(SocialUserService $service, string $provider, Request $request): RedirectResponse
    {
        $user = $service->createOrGetUser(Socialite::driver($provider)->user(), $provider);

        if (Auth::guard()->login($user, true)) {
            return redirect()->route('dashboard');
        }

        $request->session()->flash('danger', trans('login_fail'));
        return redirect()->route('login');
    }
}
