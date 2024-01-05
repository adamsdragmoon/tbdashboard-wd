<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login() {
        return view('auth.login', [
            'name' => 'Adams',
            'link' => '/login',
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request) {

        $adalogin = User::where('username', $request->username)->first();


        if($adalogin->isLogin == true) {
                return back()->with('errorLogin', 'User already login!');
            }
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)) {
            User::where('username', $request->username)->update(['isLogin' => true]);
            $request->session()->regenerate();
            return redirect()->intended('/');
        } 
        
        return back()->with('errorLogin', 'Login Failed!');
         
    }

    public function logout(Request $request) {
        $username = auth()->user()->username;
        Auth::logout();
        User::where('username', $username)->update(['isLogin' => false]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
