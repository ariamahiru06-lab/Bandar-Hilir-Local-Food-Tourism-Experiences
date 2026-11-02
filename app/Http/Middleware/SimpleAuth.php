<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class SimpleAuth
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('user_id')) {
        // remember intended URL
        $request->session()->put('intended', $request->fullUrl());
        return redirect()->route('login.show')->with('error', 'Please login first.');
    }
    return$next($request);
    }
}