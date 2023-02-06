<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function handleRedirectAuth(Request $request){
        switch ($request->driver) {
            case 'google': return Socialite::driver('google')->redirect(); 
            case 'facebook': return Socialite::driver('facebook')->redirect();
            case 'telegram':return Socialite::driver('telegram')->redirect();
            default: return '';
          }
    }
    public function googleCallback(){
        $user = Socialite::driver('google')->user();
        dd($user);
    }
    public function facebookCallback(){
        $user = Socialite::driver('facebook')->user();
        dd($user);
    }
    public function telegramCallback(){
        $user = Socialite::driver('telegram')->user();
        dd($user);
    }
}
