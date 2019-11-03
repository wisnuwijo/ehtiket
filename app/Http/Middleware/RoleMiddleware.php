<?php

namespace Ehtiket\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\URL;
use DB;

class RoleMiddleware
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
        $role = Auth::user()->role_id;
        $base_url = URL::to('/');
        $url      = url()->current();

        if ($url == url('/')) {
            $app_url = '/';
        } else {
            $get_main_url  = substr($url, strlen($base_url) + 1);
            $detect_slash = strpos($get_main_url, '/');
            if ($detect_slash > 0) {
                $explode_main_url = explode('/', $get_main_url);
                $app_url = $explode_main_url[0];
            } else {
                $app_url = $get_main_url;
            }
        }

        $getModule = DB::table('table_modules')
                    ->where('module_url', $app_url)
                    ->first();

        if (isset($getModule)) {
            $checkRoleAccess = DB::table('table_roles_access')
                                ->where([
                                    ['role_id',$role],
                                    ['module_id', $getModule->id],
                                ])
                                ->get();

            if (count($checkRoleAccess) > 0) {
                return $next($request);
            } else {
                return abort(403,'Maaf kamu tidak mempunyai akses untuk halaman ini');
            }

        } else {
            return abort(403, 'Maaf kamu tidak mempunyai akses untuk halaman ini');
        }
    }
}
