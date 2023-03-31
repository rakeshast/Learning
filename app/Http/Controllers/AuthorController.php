<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function index(Request $req){
        return view('back.pages.home');
    }

    public function logout(Request $req){
        Auth::guard('web')->logout();
        return redirect('/author/login');
    }
}
