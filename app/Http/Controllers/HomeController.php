<?php

namespace App\Http\Controllers;

use Auth;
use Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    

   
    public function index()
    {  
       
        return view('index.index');
    }
   
}
