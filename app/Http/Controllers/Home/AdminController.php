<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends ConfigController
{
    public function index() {
        return view('home.admin.index');
    }
}
