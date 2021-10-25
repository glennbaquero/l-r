<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CellMiddleware
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
        $user = $request->user();

        if (!$user || $user->group->name != 'Administrator') {
            return $this->abort($request);
        }

        return $next($request);
    }

    protected function abort($request) {
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Permission denied.',
            ], 401);
        }

        return abort(401); 
    }
}
