<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class HospitalityMiddleWare {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (Auth::user()->user_type == 'Hospitality') {
			return $next($request);
		} else {
			return back();
		}
	}
}
