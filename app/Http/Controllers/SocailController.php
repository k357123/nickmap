<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Socialite;
use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;

class SocailController extends Controller
{
    public function redirect($socailname)
    {

        // echo Str::random(40);
        // echo '<br>';
        // echo bin2hex(random_bytes(128/8));
        // return false;
        // return Socialite::driver('google')->redirect();

        return Socialite::driver($socailname)->redirect();
    }

    public function callback($socailname, Request $request)
    {

        // $authUser = Socialite::driver('google')->user();

        $authUser = Socialite::driver($socailname)->user();
        $email = $authUser->email;
        $id = $authUser->id;
        $name = $authUser->name;

        $user = User::where(['email' => $email, $socailname . '_id' => $id])->get()->first();
        if ($user) {
            Auth::login($user);
            return redirect('/shop');
        }

        $user = User::where('email', $email)->get()->first();
        if ($user == null) {

            $create = [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make(uniqid()),
                $socailname . '_id' => $id,

            ];
            $user = User::create($create);
            Auth::login($user);
            return redirect('/shop');
        } else {
            $user=User::where('id', $user->id)->update([$socailname . '_id' => $id]);
            Auth::login($user);
            return redirect('/shop');
        }
    }
}
