<?php

namespace App\Http\Controllers;

use Auth;
use Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return view('home', [
                'active_menu' => 'dashboard',
            ]);
        }

        return view('auth.login');
    }
    public function lang($locale)
    {
        if (in_array($locale, Config::get('app.locales'))) {
            session(['locale' => $locale]);
          }
          return redirect()->back();
    }
}
