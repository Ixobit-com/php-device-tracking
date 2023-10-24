<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @param string $role
     * @return Response
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (auth()->user()?->hasRole($role)) {
            return $next($request);
        }

        throw new AuthorizationException('Forbidden');
    }
}
