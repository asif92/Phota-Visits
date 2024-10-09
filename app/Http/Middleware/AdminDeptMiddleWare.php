<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class AdminDeptMiddleWare {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::user()->user_type == 'AdminDept') {
			return $next($request);
		} else {
			return back();
		}
	}
}
