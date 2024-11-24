<?php

namespace App\Http\Middleware;

use App\Http\Traits\Responser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AccessibleLearnable
{
    use Responser;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $learnable_id = request()->route()->parameters['learnable'] ?? null;
        $isAuthorized = auth('api')->user()->activeSubscriptions()->where('learnable_id', $learnable_id)->exists()
            || auth('api')->user()->learnablesAsTeacher()->where('learnables.id', $learnable_id)->exists();

        if ($isAuthorized) {
            return $next($request);
        } else {
            return $this->responseCustom(status: 401, message: __('messages.You are not authorized to access this resource'));
        }
    }
}
