<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\PermissionRole;
use Closure;
use Illuminate\Http\Request;

class PermissionAccess
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
        $user = auth('api')->user();
        $method = $request->method();
        $ruta = $this->clearPath($request->path());
        $id_permission = Permission::where([['url', '=', $ruta], ['method', '=', $method]])->value('id'); //consulta a la base de datos para obtener el id del permiso
        if (PermissionRole::where([['role_id', '=', $user->role_id], ['permission_id', '=', $id_permission]])->exists()) {
            return $next($request);
        } else {
            return response()->json(['The user does not have access rights to the content.'], 403);
        }
    }

    /**
     * funcion para quitar la palabra api y reemplazar los numeros
     * por ? de la ruta contenida en la respusta
     * @param path la ruta contenida en la respuesta
     * @return newRuta la nueva ruta despues del reemplazo
     */
    public function clearPath($path)
    {
        $ruta = str_replace("api", "", $path);
        return preg_replace('/[\d]/', '?', $ruta);
    }
}
