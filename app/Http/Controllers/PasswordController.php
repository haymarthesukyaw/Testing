<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Log;

class PasswordController extends Controller
{
    use SendsPasswordResetEmails;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function ttt()
    {
        log::info("here.................");
    }

}
