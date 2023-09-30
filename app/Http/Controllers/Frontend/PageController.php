<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home() : View 
    {
        return view('frontend.home');
    }   

    public function profile() 
    {
        return view('frontend.profile');    
    }
}
