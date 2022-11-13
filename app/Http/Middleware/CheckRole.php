<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = [
            'superAdmin' => [1],
            'company' => [2],
            'manager' => [3],
            'selsExecutive' => [4],
        ];
        $roleIds = $roles[$role] ?? [];
        if (!in_array(auth()->user()->role_id, $roleIds)) {
            abort('403');
        }
        return $next($request);
    }
}
