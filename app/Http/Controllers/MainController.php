<?php

namespace App\Http\Controllers;


class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('main.index');
    }


    public function about()
    {
        return view('main.about');
    }

}
