<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\Controller;

class AppController extends Controller
{

    public function getApp()
    {
        return view('welcome');
    }

    public function getLogin()
    {
        return view('auth.login');
    }

}