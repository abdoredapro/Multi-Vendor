<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Throwable;

class SocialLoginController extends Controller
{
    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider) {
        // try {
            $callback_user = Socialite::driver($provider)->user();
        
            $user = User::Where([
                'provider'=> $provider,
                'provider_id'=> $callback_user->id,
            ])->first();
    

            
            if(!$user) {
                $user = User::create([
                    'name' => $callback_user->name,
                    'email' => $callback_user->email,
                    'password' => Hash::make(Str::random(8)),
                    'provider'=> $provider,
                    'provider_id'=> $callback_user->id,
                    'provider_token'=> $callback_user->token,
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');


        // } catch (Throwable $e) {
        //     return redirect()->route('login')->withErrors([
        //         'email' => $e->getMessage(),
        //     ]);
        // }
    }
}
