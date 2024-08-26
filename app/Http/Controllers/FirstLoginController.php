<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirstLoginController extends Controller
{
    public function index()
    {
        return view('profile.first-login', [
            'user' => Auth::user()
        ]);
    }
}
