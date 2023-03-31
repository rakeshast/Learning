<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('author/*') ) { routeIs
                session()->flash('fail', 'You must login first');               
                return '/author/login';
                // return redirect()->route('author.login');
                //return redirect('author/login');
            }
            // Request::is('admin/*')

            // dd($request->url());
            // return route('login');
            //if ($request->routeIs('author.*')) {
                
                // session()->flash('fail', 'You must login first');
                // return redirect()->route('author.login');
                // // return redirect('author/login');
            //}
        }
    }
}
