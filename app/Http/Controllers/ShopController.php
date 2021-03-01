<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\User;

class ShopController extends BaseController
{
    public function cc(){
        // print_r(Cookie::get());
        // $loginStatus=Auth::check();
        // $a=Auth::attempt(['email'=>'test@gmail.com','password'=>'12345678']);
        // Auth::loginUsingId(1);
        // Auth::logout();
        // print_r(session()->all());
        $a=Cookie::get('dd');
        $count=$a==null?0:count(json_decode($a,true));
        // $count=count(json_decode($a,true));
        // print_r($count);
        // return false;
 
        return View('shop')->with('product',Shop::all())->with('count',$count);
    }
}

