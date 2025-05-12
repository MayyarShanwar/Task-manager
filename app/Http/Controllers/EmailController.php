<?php

namespace App\Http\Controllers;

use App\Mail\Mailo;
use Carbon\Carbon;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Prompts\Output\ConsoleOutput;

class EmailController extends Controller
{

    public function notice(){
        return view('mail.notice');
    }
    public function verify()
    {
        Auth::user()->markEmailAsVerified();
        return redirect('/');
    }

    public function resend() {
        $user = Auth::user();
        Mail::to($user)->send(new Mailo());
        return redirect()->back();
    }
}
