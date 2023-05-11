<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class ApiPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = auth('api')->user();
        
        $permissions = is_array($permission) ? $permission : explode('|', $permission);
      
        foreach ($permissions as $permission) {
            if (Gate::forUser($user)->allows($permission))  {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Permission denied'], Response::HTTP_FORBIDDEN);
    }
}
