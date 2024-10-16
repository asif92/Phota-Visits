<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class SuperAdminMiddleWare {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::user()->user_type == 'SuperAdmin') {
			return $next($request);
		} else {
			return back();
		}
	}
}
