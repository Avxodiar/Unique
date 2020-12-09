<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function show()
    {
        return view('default.index');
    }

    public function contact(Request $request)
    {
        return __METHOD__;
    }
}
