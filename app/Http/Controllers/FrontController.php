<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome(): \Illuminate\View\View
    {
        return view('index');
    }
}
