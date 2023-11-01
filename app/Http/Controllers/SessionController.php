<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index()
    {
       if(Auth::check()){
        return redirect('/');
       }else{
        return view('session.index');
       }
    }

    public function login(Request $request)
    {
       $data = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
       ];
       if(Auth::Attempt($data)){
        return redirect('/dashboard');
       }else{
        Session::flash('error', 'Email Atau Password Salah');
        return redirect('/');
       }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

   
}
