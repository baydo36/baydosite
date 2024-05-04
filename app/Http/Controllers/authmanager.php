<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class authmanager extends Controller
{
    function login() {
        if (Auth::check()){
            return redirect (route('home'));
        }
        return view('login');
    }
    function register() {
        if (Auth::check()){
            return redirect (route('home'));
        }
        return view('register');
    }

    function loginpost (Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
         return redirect(route('login'))->with("error", "your data is wrong , please rewrite it");


    }
    
    function registerpost (Request $request){
        $request->validate ([
         'email'=>'required|email|unique:users',
         'username'=>'required',
         'password'=>'required'
        ]);
              $data ['username'] = $request->username;
              $data ['email'] = $request->email;      
              $data ['password'] = Hash::make($request->password) ;
              $user = User::create($data);
       if(!$user){
        return redirect(route('register'))->with("error", "shdmfqslkjfqlfhlqkhfqmlfhd");
       }
       return redirect(route('login'))->with("success", "ya bagra");
    }
     function logout (){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
     }
     function adminpage() {
        return view('adminpage');
     }
}
