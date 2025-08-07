<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class DiscordController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function callback()
    {
        try {
            $discordUser = Socialite::driver('discord')->user();

            // Sprawdź czy użytkownik już istnieje po Discord ID lub email
            $user = User::where('discord_id', $discordUser->getId())
                ->orWhere('email', $discordUser->getEmail())
                ->first();

            if ($user) {
                // Aktualizuj Discord ID i avatar jeśli nie istnieją
                $user->update([
                    'discord_id' => $discordUser->getId(),
                    'avatar' => $discordUser->getAvatar(),
                ]);
            } else {
                // Stwórz nowego użytkownika używając updateOrCreate (Laravel 12 style)
                $user = User::updateOrCreate([
                    'discord_id' => $discordUser->getId(),
                ], [
                    'name' => $discordUser->getName() ?? $discordUser->getNickname(),
                    'email' => $discordUser->getEmail(),
                    'avatar' => $discordUser->getAvatar(),
                    'password' => Hash::make(Str::random(24)), // Losowe hasło
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Błąd podczas logowania przez Discord: ' . $e->getMessage());
        }
    }
}
