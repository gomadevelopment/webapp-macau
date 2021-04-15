<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class IsProfessor
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
        if (!Auth::user()->isProfessor()) {
            request()->session()->flash('Não tem privilégios para aceder a esta página. Foi redireccionado para a página anterior.');
            return redirect()->back();
        }          

        return $next($request);
    }
}
