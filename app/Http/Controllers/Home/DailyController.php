<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

class DailyController extends ConfigController
{
    public function index()
    {
        return view('home.daily.index');
    }

    public function create()
    {
        return view('home.daily.create');
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
