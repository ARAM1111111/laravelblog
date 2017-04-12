<?php

namespace App\Http\Controllers;

use Socialite;
use Auth;
use App\User;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        if (User::where('email',$user->getEmail())->first()) {
            $user = User::where('email',$user->getEmail())->first();
            Auth::login($user);
            return redirect()->route('home');
        } else {
            $user =User::create([
                'name'=>$user->getName(),
                'email'=>$user->getEmail()
            ]);
            Auth::login($user);
            return redirect()->route('home');
        }       
    }
}