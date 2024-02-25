<?php

namespace App\Http\Controllers\Front\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class twoFactorAuthenticationController extends Controller
{
    public function index() {
        $user = Auth::user();
        return view('front.auth.two-factor-authenticate', compact('user'));
    }
}
