<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\OAuthProvider;
use App\Models\SocialAccount;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

final class SocialAuthController
{
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider): RedirectResponse
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Erreur lors de l\'authentification.');
        }

        // Vérifier si le compte social existe
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $socialiteUser->getId())
            ->first();

        if ($socialAccount) {
            // Compte existant : mettre à jour et connecter
            $this->updateSocialAccount($socialAccount, $socialiteUser);
            Auth::login($socialAccount->user);

            return redirect('/dashboard');
        }

        // Vérifier si un utilisateur avec cet email existe
        if ($socialiteUser->getEmail()) {
            $user = User::where('email', $socialiteUser->getEmail())->first();

            if ($user) {
                // Créer le compte social pour cet utilisateur
                $this->createSocialAccount($user, $provider, $socialiteUser);
                Auth::login($user);

                return redirect('/dashboard');
            }
        }

        // Créer un nouvel utilisateur
        $user = User::create([
            'name' => $socialiteUser->getName(),
            'email' => $socialiteUser->getEmail() ?? uniqid().'@social.local',
            'password' => bcrypt(str()->random(32)),
            'email_verified_at' => now(),
        ]);

        $this->createSocialAccount($user, $provider, $socialiteUser);
        Auth::login($user);

        return redirect('/dashboard');
    }

    private function createSocialAccount(User $user, string $provider, mixed $socialiteUser): void
    {
        $user->socialAccounts()->create([
            'provider' => OAuthProvider::from($provider),
            'provider_id' => $socialiteUser->getId(),
            'email' => $socialiteUser->getEmail(),
            'name' => $socialiteUser->getName(),
            'access_token' => $socialiteUser->token,
            'refresh_token' => $socialiteUser->refreshToken,
            'token_expires_at' => isset($socialiteUser->expiresIn) ? now()->addSeconds($socialiteUser->expiresIn) : null,
            'profile_data' => [
                'avatar' => $socialiteUser->getAvatar(),
                'raw' => $socialiteUser->user,
            ],
        ]);
    }

    private function updateSocialAccount(SocialAccount $socialAccount, mixed $socialiteUser): void
    {
        $socialAccount->update([
            'email' => $socialiteUser->getEmail(),
            'name' => $socialiteUser->getName(),
            'access_token' => $socialiteUser->token,
            'refresh_token' => $socialiteUser->refreshToken,
            'token_expires_at' => isset($socialiteUser->expiresIn) ? now()->addSeconds($socialiteUser->expiresIn) : null,
            'profile_data' => [
                'avatar' => $socialiteUser->getAvatar(),
                'raw' => $socialiteUser->user,
            ],
        ]);
    }
}
