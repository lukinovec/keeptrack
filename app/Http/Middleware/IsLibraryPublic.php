<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Http\Request;

class IsLibraryPublic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $library_owner = collect(request()->segments())->last();

        if (User::find($library_owner)?->hasPublicLibrary()) {
            return $next($request);
        } else {
            abort(403, $library_owner . "'s library is private.");
        }
    }
}
