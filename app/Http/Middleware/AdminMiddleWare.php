<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleWare {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::user()->user_type == 'Admin') {
			return $next($request);
		} else {
			return back();
		}
	}
}
