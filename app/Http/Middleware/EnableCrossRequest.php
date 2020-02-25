<?php


namespace App\Http\Middleware;


class EnableCrossRequest {
	public function handle($request,\Closure $next){
		$response = $next($request);
		$response->header('Access-Control-Allow-Origin', '*');
		$response->header('Access-Control-Allow-Headers', '*');
		$response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
		//$response->header('Access-Control-Allow-Credentials', 'false');
		return $response;
	}
}
