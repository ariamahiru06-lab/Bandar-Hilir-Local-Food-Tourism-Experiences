<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class AdminOnly
{
    public function handle(Request $request, Closure$next)
    {
        if($request->session()->get('user_role') !== 'admin') {
        return redirect()->route('dashboard')->with('error', 'Admin access required.');
        }
    return $next($request);
    }
}