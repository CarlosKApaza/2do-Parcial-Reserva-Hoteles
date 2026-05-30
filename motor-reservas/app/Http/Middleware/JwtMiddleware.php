<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $autorizacion = $request->header('Authorization');
            if (!$autorizacion) {
                return response()->json(['status' => 'Token no proporcionado'], 401);
            }
            
            $jwt = substr($autorizacion, 7); // Quita "Bearer "
            $key = env('JWT_SECRET');
            $algoritmo = env('JWT_ALGORITHM');
            
            $datos = JWT::decode($jwt, new Key($key, $algoritmo));
            $request->attributes->add(['agencia' => $datos->agencia]);   
        }
        catch (\Exception $e) {
            return response()->json(['status' => 'No autorizado: '.$e->getMessage()], 401);   
        } 
        return $next($request);
    }
}