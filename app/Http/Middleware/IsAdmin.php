<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->isAdmin()) {
            request()->session()->flash('restrict_page_error', 'Página restrita a Administradores. Foi redireccionado para a página anterior.');
            return redirect()->back();
        }          

        return $next($request);
    }
}
