<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventAdminEdit
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->route('user'); // prende il parametro {user} dalla rotta
        if ($user && $user->name === 'Admin') {
            abort(403, 'Non puoi modificare questo utente.');
        }

        return $next($request);
    }

}
