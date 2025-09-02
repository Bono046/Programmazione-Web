<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsOrganizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !(auth()->user()->role != 'operator' || auth()->user()->role != 'admin')) 
        {
             return response()->view('errors.403', ['message' => 'Accesso negato. Sei autorizzato solo come organizzazione o admin.']);
        }
        return $next($request);
    }
}
