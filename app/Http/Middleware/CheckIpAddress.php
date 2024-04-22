<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIpAddress
{
    public function handle(Request $request, Closure $next): Response
    {
        #IP白名單
        // $allowedIps = ['127.0.0.1', '192.168.1.1', '211.75.42.64'];

        // if (!in_array($request->ip(), $allowedIps)) {
        //     return response()->json(['error' => '??????'], 403);
        // }

        return $next($request);
    }
}
