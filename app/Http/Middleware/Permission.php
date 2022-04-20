<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        $user_has_perm = DB::table('role_user')
            ->join('permission_role', 'role_user.role_id', 'permission_role.role_id')
            ->join('permissions', 'permission_role.permission_id', 'permissions.id')
            ->where('role_user.user_id', Auth::id())
            ->where('permissions.name', 'LIKE','%'.$request->path().'%')
            ->exists();

        if ($user_has_perm) {
            return $next ($request);
        }
        abort(403, 'UNAUTHORIZED');
    }

}
