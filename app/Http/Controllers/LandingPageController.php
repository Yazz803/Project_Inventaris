<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index() {
        return view('landingpagebaru.index');
    }

    public function login(){
        return view('landingpagebaru.login');
    }
}
