<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index (){
        Log::debug('An informational message.');
        return view('home');
    }
}
