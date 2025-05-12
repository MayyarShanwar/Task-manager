<?php

namespace App\Http\Controllers;

use App\Mail\Mailo;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserController extends Controller
{
    public function home()
    {
        return view('auth.signup');
    }

    public function signup()
    {
        $userAttr = request()->validate([
            'first_name' => 'required|max:10',
            'last_name' => 'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);


        $user = User::create($userAttr);

        Mail::to($user)->send(new Mailo());

        return redirect('/login')->with('message','Your account aas been created,please verify your email and login.');
    }

    public function loginView()
    {
        return view('auth.login');
    }

    public function login()
    {
        $userAttr = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($userAttr,request('remember-token'))) {
            return redirect('/');
        }
        else{
            return redirect('login')->withErrors(['login'=>'This user is not Found!']);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        //end the session
        $request->session()->invalidate();
        //delete csrf
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
