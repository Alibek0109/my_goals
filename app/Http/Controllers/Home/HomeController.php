<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

class HomeController extends ConfigController
{
    public function index()
    {
        return view('home.index');
    }
}
