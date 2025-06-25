<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }
    public function handleFacebookCallback(){
        try {
            $user = Socialite::driver('facebook')->user();
            dd($user);
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->route('home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
