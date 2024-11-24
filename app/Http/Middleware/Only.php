<?php

namespace App\Http\Middleware;

use App\Http\Traits\Responser;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Only
{
    use Responser;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $userType): Response
    {
        if (auth('api')->user()?->type != $userType) {
            return $this->responseCustom(status: 401, message: __('messages.You are not authorized to access this resource'));
        }
        return $next($request);
    }
}
