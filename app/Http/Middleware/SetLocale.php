<?php

  namespace App\Http\Middleware;

  use Closure;
  use Session;
  use App;
  use Config;


  class SetLocale
  {
    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      if (Session::has('locale')) {
          $locale = Session::get('locale');
      } else {
          $locale = Config::get('app.locale');       
         
      }
      session(['locale' => $locale]);
      App::setLocale($locale);
      
      return $next($request);

    }
  }
